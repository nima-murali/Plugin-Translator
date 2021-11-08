const { __ } = wp.i18n;
window.addEventListener('load', (event) => {
  //console.log('page is fully loaded');
  alert(__("The changes you made will be lost",'plugin_translator'));
});