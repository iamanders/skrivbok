import Ember from 'ember';

export default Ember.Route.extend({
	beforeModel: function(transition) {
		if(!this.get('session').get('isAuthenticated')) {
			transition.abort();
			this.transitionTo('login');
		}
	},
	model: function(params) {
		return this.store.find('note', params.note_id);
	},
	afterModel: function(model) {
		$(document).attr('title', model.get('title') + ' - Skrivbok' );
	}
});
