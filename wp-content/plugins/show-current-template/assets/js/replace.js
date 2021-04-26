function replaceFileNames() {
	let c = document.getElementById('included-files-fie-on-wp-footer').innerHTML;
	document.getElementById('included-files-list').innerHTML = c;
}
jQuery( function() { 
	replaceFileNames();
});