import Ember from 'ember';
import config from './config/environment';

var Router = Ember.Router.extend({
  location: config.locationType
});

export default Router.map(function() {
  this.resource('note', function() {
  	this.route('show', { path: '/:note_id' });
  	this.route('remove', { path: '/:note_id/remove' });
  	this.route('new', { path: '/new' });
  });
  this.route('login');
  this.route('logout');
});
