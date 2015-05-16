import Ember from 'ember';

export function formatDate(params/*, hash*/) {
	if(!params[1]) { params[1] = 'YYYY-MM-DD'; }
	return moment(params[0] * 1000).format(params[1]);
}

export default Ember.HTMLBars.makeBoundHelper(formatDate);
