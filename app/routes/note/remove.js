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
	afterModel: function() {
		$(document).attr('title', 'Are you sure? - Skrivbok' );
	},
	actions: {
		remove: function() {
			var self = this;

			this.currentModel.destroyRecord().then(function() {
				self.transitionTo('note');
			});
		},
		cancel: function() {
			this.transitionTo('note.show', this.currentModel.id);
		},
	},
});
