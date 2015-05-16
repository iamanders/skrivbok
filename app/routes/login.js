import Ember from 'ember';

export default Ember.Route.extend({
	activate: function() {
		if(this.get('session').get('isAuthenticated')) {
			this.transitionTo('note');
		}
	},
});
