import Ember from 'ember';

export function formatDateAgo(params/*, hash*/) {
	return moment(moment(params[0] * 1000), "YYYYMMDD").fromNow();
}

export default Ember.HTMLBars.makeBoundHelper(formatDateAgo);
