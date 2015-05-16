import Ember from 'ember';
import Base from 'simple-auth/authenticators/base';

export default Base.extend({
	tokenEndpoint: '/api/session',

	restore: function(data) {
		return new Ember.RSVP.Promise(function(resolve, reject) {
			if (!Ember.isEmpty(data.token)) {
				resolve(data);
			} else {
				reject();
			}
		});
	},
	authenticate: function(options) {
		var _this = this;
		var identification = options.identification;
		var password = options.password;

	  	return new Ember.RSVP.Promise(function(resolve, reject) {
			Ember.$.ajax({
				url: _this.tokenEndpoint,
				type: 'POST',
				data: JSON.stringify({ mail: identification, password: password }),
				contentType: 'application/json'
			}).then(function(response) {
				Ember.run(function() {
					resolve({ token: response.token, mail: response.user.mail });
				});
			}, function(xhr, status, error) {
				Ember.run(function() {
					reject(error);
				});
			});
		});

	},
	invalidate: function(data) {
		var _this = this;
		return new Ember.RSVP.Promise(function(resolve) {
			Ember.$.ajax({ url: _this.tokenEndpoint, type: 'DELETE' }).always(function() {
				resolve();
			});
		});
	}
});
