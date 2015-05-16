import Ember from 'ember';

export default Ember.Controller.extend({
	actions: {
      authenticate: function() {
        var _this = this;
        var credentials = this.getProperties('identification', 'password');
        this.get('session').authenticate('authenticator:custom', credentials).then(null, function(message) {
          _this.set('errorMessage', message);
        });
      }
    }
});
