import Ember from 'ember';

export default Ember.ArrayController.extend({
	sortProperties: ['updated_at'],
	sortAscending: false,
});
