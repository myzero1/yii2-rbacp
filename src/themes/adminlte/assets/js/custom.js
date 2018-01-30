
/*---------custom.----------------*/
/*---------for rbacp-role,start.----------------*/

$('.privilege-item input').click(function(){ //ifCreated 事件应该在插件初始化之前绑定

  var privilege_id = $(this).parents('.privilege-item').attr('privilege_id');

  if (!$(this).prop("checked")) {
    $(".privilege-item-"+privilege_id+" input").prop('checked', false);
  } else {
    $(".privilege-item-"+privilege_id+" input").prop('checked', true);
  }
});

$('.policy-item input').click(function(){ //ifCreated 事件应该在插件初始化之前绑定
  var policy_id = $(this).parents('.policy-item').attr('policy_id');
  var privilege_id = $(this).parents('.policy-item').attr('privilege_id');

  if (!$(this).prop("checked")) {
    unCheckedParent (".policy-item.privilege-item-"+privilege_id+" input", ".privilege-item.privilege-item-"+privilege_id+" input");
    $(".policy-item-data.policy-item-"+policy_id+" input").prop('checked', false);
  } else {
    $(".policy-item-"+policy_id+" input").prop('checked', true);
    $(".privilege-item.privilege-item-"+privilege_id+" input").prop('checked', true);
  }
});

$('.policy-item-data input').click(function(){ //ifCreated 事件应该在插件初始化之前绑定
  var policy_id = $(this).parents('.policy-item-data').attr('policy_id');
  var privilege_id = $(this).parents('.policy-item-data').attr('privilege_id');

  if (!$(this).prop("checked")) {
    unCheckedParent (".policy-item-data.policy-item-"+policy_id+" input", ".policy-item.policy-item-"+policy_id+" input");
    unCheckedParent (".policy-item.privilege-item-"+privilege_id+" input", ".privilege-item.privilege-item-"+privilege_id+" input");
  } else {
    $(".policy-item.policy-item-"+policy_id+" input").prop('checked', true);
    $(".privilege-item.privilege-item-"+privilege_id+" input").prop('checked', true);
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

  if (iCheckedCount === 0) {
    $(sUncheckedSelector).prop('checked', false);
  } else {
    // coding
  }
}

/*---------for rbacp-role,end.----------------*/