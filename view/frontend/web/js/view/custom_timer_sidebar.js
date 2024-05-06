define([
'uiComponent',
'ko',
'jquery',
'mage/url'
], function(Component, ko, $, url) {
'use strict';
return Component.extend({
     initialize: function () {
         this._super();
     },
     isenable:function()
     {
      var isenable1=window.checkoutConfig.payment.custom_config.ischecouttimerenabled;
      return isenable1;
     },
     checkouttimelabel:function()
     {
      var checkouttimelabel=window.checkoutConfig.checkouttimelabel.custom_config.checkouttimelabel;
      return document.getElementById("countdown1").innerHTML = checkouttimelabel;
     },
     getClock: function () {
     var siteurl = url.build('checkouttimer/index/index');
      $.ajax({
        type: 'POST',
        url: siteurl,
        showLoader: false,
        cache: false,
        success: function (response) {
          var data = $.parseJSON(response);
          if (data.message.trim() == 'true') {
            var date = data.date;
             var timeZone = data.nowtime;
            var countDownDate = new Date(date).getTime();
            var nowtime=data.nowtime;
            // Update the count down every 1 second
            var x = setInterval(function() {
             // Get today's date and time
             var newdate=new Date().toLocaleString("en-US", {timeZone: timeZone});;
             //console.log("current time"+newdate);
              var now = new Date(newdate).getTime();
              // Find the distance between now and the count down date 
              var distance = countDownDate - now;
              var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
              var seconds = Math.floor((distance % (1000 * 60)) / 1000);
              // Output the result in an element with id="demo"
              document.getElementById("countdown").innerHTML = minutes + "m " + seconds + "s ";
              // If the count down is over, write some text 
              if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown").innerHTML = "Cart expired.";
                document.getElementById("countdown1").innerHTML = "";
                var siteurl = url.build('clearquote/index/quoteclear');
                //console.log(siteurl);
                 $.ajax({
                      type: 'POST',
                      url: siteurl,
                      showLoader: false,
                      cache: false,
                      success: function (response) {
                        console.log(response);
                        var data = $.parseJSON(response);
                        if (data.message.trim() == 'true') 
                        {
                           return location.reload();
                        }else
                        {
                           return location.reload();
                        }
                      }
                    }); 
              }
    }, 1000);     
          }
        }
      });       
     }
});
});