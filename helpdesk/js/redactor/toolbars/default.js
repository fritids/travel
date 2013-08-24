if (typeof RTOOLBAR == 'undefined') var RTOOLBAR = {};

RTOOLBAR['default'] = 
{
	
	pre:
	{  
			 	title: RLANG.code,
			 	exec: 'formatblock',
			 	param: '<pre>',
			 	style: 'font-family: monospace, sans-serif;'
	},
	bold:
	{ 
		title: RLANG.bold,
		exec: 'Bold',
	 	param: false	
	}, 
	italic:
	{
		title: RLANG.italic,
		exec: 'italic',
	 	param: null
	},
	deleted:
	{
		title: RLANG.deleted,
		exec: 'strikethrough',
	 	param: null,
		separator: true	 		
	},	
	insertunorderedlist:
	{
		title: '&bull; ' + RLANG.unorderedlist,
		exec: 'insertunorderedlist',
	 	param: null
	},
	insertorderedlist:
	{
		title: '1. ' + RLANG.orderedlist,
		exec: 'insertorderedlist',	
	 	param: null
	},
	file:
	{
		title: RLANG.file,
		func: 'showFile'
	},	
	link:
	{ 
		title: RLANG.link,
		func: 'show', 				
		dropdown: 
		{
			link:
			{
				title: RLANG.link_insert, 
				func: 'showLink'
			},
			unlink: 
			{
				title: RLANG.unlink,
				exec: 'unlink', 
			 	param: null
			}
		},
		separator: true															
	}
};