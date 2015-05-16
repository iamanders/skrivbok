import Ember from 'ember';

export default Ember.Route.extend({
	beforeModel: function(transition) {
		if(!this.get('session').get('isAuthenticated')) {
			transition.abort();
			this.transitionTo('login');
		}
	},
	model: function() {
		return this.store.createRecord('note');
	},
	afterModel: function() {
		$(document).attr('title', 'New document - Skrivbok' );
	},
	activate: function() {

	},
	deactivate: function() {
		this.currentModel.rollback();
	},
	actions: {
		saveNote: function() {
			var self = this;
			var note = this.currentModel;

			note.save().then(function() {
				self.transitionTo('note.show', note.id);
			});
		}
	}
});
