//Custom javascript for the GPC3 theme

Drupal.behaviors.gpc3_theme = function () {
	$("#block-phplist-0 #edit-mail").focus(
	 function()
	 {
	  // only select if the text has not changed
	  if(this.value == this.defaultValue)
	  {
	   this.value = "";
	  }
	 }
	);
}; 