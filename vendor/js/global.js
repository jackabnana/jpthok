///// Check Box Select All //////
//var global_url = 'http://localhost/onlinevandy/';
//var global_vendor_url = 'http://localhost/onlinevandy/vendor/';

var global_url = 'https://www.thokvikreta.com/';
var global_vendor_url = 'https://www.thokvikreta.com/vendor/';

$(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
});

///// Show Or Hide Div /////
function showhide(id) {
   var e = document.getElementById(id);
   if(e.style.display == 'block')
   e.style.display = 'none';
   else
   e.style.display = 'block';
}

//// Text Editor /////

// The instanceReady event is fired, when an instance of CKEditor has finished

// its initialization.

CKEDITOR.on( 'instanceReady', function( ev ) {
	// Show the editor name and description in the browser status bar.
	document.getElementById( 'eMessage' ).innerHTML = 'Instance <code>' + ev.editor.name + '<\/code> loaded.';
	// Show this sample buttons.
	document.getElementById( 'eButtons' ).style.display = 'block';
});
function InsertHTML() {
	// Get the editor instance that we want to interact with.
	var editor = CKEDITOR.instances.editor1;
	var value = document.getElementById( 'htmlArea' ).value;
	// Check the active editing mode.
	if ( editor.mode == 'wysiwyg' )
	{
	// Insert HTML code.
	// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-insertHtml
	editor.insertHtml( value );
	}
	else
	alert( 'You must be in WYSIWYG mode!' );
}
function InsertText() {
	// Get the editor instance that we want to interact with.
	var editor = CKEDITOR.instances.editor1;
	var value = document.getElementById( 'txtArea' ).value;
	// Check the active editing mode.
	if ( editor.mode == 'wysiwyg' )
	{
	// Insert as plain text.
	// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-insertText
	editor.insertText( value );
	}
	else
	alert( 'You must be in WYSIWYG mode!' );
}
function SetContents() {
	// Get the editor instance that we want to interact with.
	var editor = CKEDITOR.instances.editor1;
	var value = document.getElementById( 'htmlArea' ).value;
	// Set editor contents (replace current contents).
	// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-setData
	editor.setData( value );

}
function GetContents() {
	// Get the editor instance that you want to interact with.
	var editor = CKEDITOR.instances.editor1;
	// Get editor contents
	// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-getData
	alert( editor.getData() );
}
function ExecuteCommand( commandName ) {
	// Get the editor instance that we want to interact with.
	var editor = CKEDITOR.instances.editor1;
	// Check the active editing mode.
	if ( editor.mode == 'wysiwyg' )
	{
	// Execute the command.
	// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-execCommand
	editor.execCommand( commandName );
	}
	else
		alert( 'You must be in WYSIWYG mode!' );
}
function CheckDirty() {
	// Get the editor instance that we want to interact with.
	var editor = CKEDITOR.instances.editor1;
	// Checks whether the current editor contents present changes when compared
	// to the contents loaded into the editor at startup
	// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-checkDirty
	alert( editor.checkDirty() );
}
function ResetDirty() {
	// Get the editor instance that we want to interact with.
	var editor = CKEDITOR.instances.editor1;
	// Resets the "dirty state" of the editor (see CheckDirty())
	// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-resetDirty
	editor.resetDirty();
	alert( 'The "IsDirty" status has been reset' );
}
function Focus() {
	CKEDITOR.instances.editor1.focus();
}
function onFocus() {
	document.getElementById( 'eMessage' ).innerHTML = '<b>' + this.name + ' is focused </b>';
}
function onBlur() {
	document.getElementById( 'eMessage' ).innerHTML = this.name + ' lost focus';
}




function change_status(str)
{	
	    var url = "id="+str+"&make=unfeature";
		$.ajax(
		{
		url : "listing.php",
		type: "POST",
		data : url,
		beforeSend: function() {
		// setting a timeout
		$('#feature_'+str).text('loading...');
		},
		success:function(data) 
		{
		$('#feature_'+str).hide();
		$('#unfeature_'+str).show();
		$('#feature_'+str).text('Feature');
		}
	});
}
function show_filter(str)
{
	
	//alert(str);
	$.ajax(
	{
		url : global_vendor_url+"active.php?pid="+str,
		type: "POST",
		data : 'HTML',
		beforeSend: function() {
		// setting a timeout
		$('#search_loading').show();
		},
		success:function(data, textStatus, jqXHR) 
		{
			//alert(data);
			$("#calculatorPOSE86J3PUYNXD7C").show();
			$('#search_loading').hide();	
			$("#calculatorPOSE86J3PUYNXD7C").html(data);
		}
	});
}
function hide_filter()
{
	//$("#calculatorPOSE86J3PUYNXD7C").slideToggle("slow");
	$("#calculatorPOSE86J3PUYNXD7C").hide();
}
function show_seller_form()
{
	
	$(".show_seller_form").show();
}