import Ember from 'ember';

export default Ember.Controller.extend({
	actions: {
		editDone: function() {
			if(this.get('model').get('isDirty')) {
				this.get('model').save();
			}
		}
	}
});
