import Ember from 'ember';

export default Ember.Handlebars.makeBoundHelper(function(value) {
	var escaped = Ember.Handlebars.Utils.escapeExpression(value);
	return new Ember.Handlebars.SafeString('<span class="highlight">' + escaped.replace(/\n/g, '<br />') + '</span>');
});
