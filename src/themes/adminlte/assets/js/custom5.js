/*---------custom.----------------*/
/*---------for rbacp-role,start.----------------*/

$('.privilege-item input').on('ifClicked', function(event){ //ifCreated 事件应该在插件初始化之前绑定
	var privilege_id = $(this).parents('.privilege-item').attr('privilege_id');

	if ($(this).prop("checked")) {
		$(".privilege-item-"+privilege_id+" input").iCheck('uncheck');
	} else {
		$(".privilege-item-"+privilege_id+" input").iCheck('check');
	}
});

$('.policy-item input').on('ifClicked', function(event){ //ifCreated 事件应该在插件初始化之前绑定
	var policy_id = $(this).parents('.policy-item').attr('policy_id');
	var privilege_id = $(this).parents('.policy-item').attr('privilege_id');

	if ($(this).prop("checked")) {
		$(".policy-item-"+policy_id+" input").iCheck('uncheck');
	} else {
		$(".policy-item-"+policy_id+" input").iCheck('check');
		$(".privilege-item.privilege-item-"+privilege_id+" input").iCheck('check');
	}
});

$('.policy-item-data input').on('ifClicked', function(event){ //ifCreated 事件应该在插件初始化之前绑定
	var policy_id = $(this).parents('.policy-item-data').attr('policy_id');
	var privilege_id = $(this).parents('.policy-item-data').attr('privilege_id');

	if ($(this).prop("checked")) {
		unCheckedParent (".policy-item-data.policy-item-"+policy_id+" input", ".policy-item.policy-item-"+policy_id+" input");
	} else {
		$(".policy-item.policy-item-"+policy_id+" input").iCheck('check');
		$(".privilege-item.privilege-item-"+privilege_id+" input").iCheck('check');
	}
});

function unCheckedParent (sEachItemSelector, sUncheckedSelector) {
	var iCheckedCount = 0;
	$(sEachItemSelector).each(function(){
	    if ($(this).prop("checked")) {
	    	iCheckedCount ++;
	    } else {
	    	// coding
	    }
	});
	// console.log(iCheckedCount);
	if (iCheckedCount === 1) {
		$(sUncheckedSelector).iCheck('uncheck');
	} else {
		// coding
	}
}

/*---------for rbacp-role,end.----------------*/