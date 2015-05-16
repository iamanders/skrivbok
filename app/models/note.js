import DS from 'ember-data';

export default DS.Model.extend({
	created_at: DS.attr('number'),
	updated_at: DS.attr('number'),
	title: DS.attr('string'),
	body: DS.attr('string'),
});
