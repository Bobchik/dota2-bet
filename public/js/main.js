$(document).ready(function () {

    $('.bet_submit').click(function (e) {
        e.preventDefault();
        var bet = $(this).attr("value");
        var lobby_id = $('meta[name="lobby_id"]').attr('content');
        var user_id = $('meta[name="user_id"]').attr('content');
        $('#exampleModal').modal('hide');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: lobby_id+"/bet/"+bet,
            data:{
                bet: bet
            },
            success: function (response) {
		    document.getElementById('user_cash').innerHTML = "Wallet:" + response.coins;
        	document.getElementById('bet_'+user_id).innerHTML = response.bet;
            document.getElementById('bank').innerHTML = response.bank + "$";
            },
            error: function(xhr) {
        //var err = response.error;
        alert(xhr.responseJSON.error);
       // alert(xhr.textStatus);
  }
        });
    });
    $('.exit').click(function (e) {
        e.preventDefault();

        $('#exampleModal2').modal('hide');
    });

    $('.report-submit').click(function (e) {
        e.preventDefault();

        var value = $('input[type="radio"]:checked').attr('value');
        var id = window.location.pathname.split('/')[2];

        $('#exampleModal3').modal('hide');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: '/profile/'+ id +'/report',
            data: {
                value:value
            },
            success: function (response) {
                alert(response);
            }
        });
    });
});
