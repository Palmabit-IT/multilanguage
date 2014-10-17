"use strict";
$(document).ready(function(){
    $('#change-language').on('change',function(){
      window.location.href = $(this).val();
    });
});
