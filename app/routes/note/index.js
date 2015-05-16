import Ember from 'ember';

export default Ember.Route.extend({
	beforeModel: function(transition) {
		if(!this.get('session').get('isAuthenticated')) {
			transition.abort();
			this.transitionTo('login');
		}
	},
	model: function() {
		return this.store.find('note');
	},
	afterModel: function() {
		$(document).attr('title', 'Skrivbok');
	}
});
