
function update_factory_key_id() {


	ajax_templtate('giant_se/admin.do',
	function() {return   {cmd : 'LIST_FACTORY_KEY_ID',params : {}	}	},
	function(data) {
		$('.select_fct').each(
			function (i) {
					$(this).remove();
			});

		//console.log(data);
			$.each(data.list_param, function( index, value ) {
				$('#factory_key_id_select').append(String.format("<li class='select_fct'><a href='#' id='{0}' class='factory_key_id_option' >{0}</a></li>",value.factory_key_id));
			});

			$('.factory_key_id_option').click(
					function() {

						$('#factory_key_id').val(this.id);
							console.log(this.id);

					});



	});

}

function update_company_no() {


	ajax_templtate('giant_se/admin.do',
	function() {return   {cmd : 'LIST_COMAPANY_NO',params : {}	}	},
	function(data) {
		$('.select_comp').each(
			function (i) {
					$(this).remove();
			});

		//console.log(data);
			$.each(data.list_param, function( index, value ) {
				$('#company_no_select').append(String.format("<li class='select_comp'><a href='#' id='{0}' class='company_no_option' >{1}</a></li>",value.company_no,value.name));
			});

			$('.company_no_option').click(
					function() {

            var company_no = this.id;
            var name = $(this).text();

						$('#company_no').val(company_no);
            $('#name').val(name);
            console.log($(this).text());
						update_company_info(company_no);


					});



	});

}


function update_company_info(company_no) {
  ajax_templtate('giant_se/admin.do',
	function() {return   {cmd : 'GET_COMPANY_INFO',params : {company_no:company_no}	}	},
	function(data) {

		$('#factory_key_id').val(data.params.factory_key_id);
		$('#name').val(data.params.name);
		$('#description').val(data.params.description);
		$('#url').val(data.params.url);
		$('#url_img').val(data.params.url_img);





	});

}
		//function abc(a1,a2,a3,a4);
		$(function() {
			console.log('ready');




			//
			//update_company_no();
			//update_factory_key_id();


      var default_info = {
        group_0: {
            button: {
                id: "input_company_info",
                lable: "회사정보 입력"
            },
            inputs: [
                {
                    id: "site",
                    lable: "사이트이름"
                },
                {
                    id: "header",
                    lable: "헤더이름"
                },
								{
										id: "tail",
										lable: "테일이름"
								},
								{
										id: "etc",
										lable: "기타정보"
								},
            ]
        }

      };




//	console.log(input_info);
  make_form('#default_form',default_info);


  $('#reg_toggle').click(
      function() {
          $('#reg_form').toggle();

      });


			console.log($('.factory_key_id_option'));

			$('.factory_key_id_option').click(
					function() {
							console.log(this.id);

					});




			btn_templtate('#input_company_info', 'giant_se/admin.do',
			function() {
				var name =  $('#name').val();;
        var company_no =   $('#company_no').val();;
        var factory_key_id = $('#factory_key_id').val();;
				var description = $('#description').val();;
				var url = $('#url').val();;
				var url_img = $('#url_img').val();;


        return   {cmd : 'UPDATE_COMAPANY',params : {
					name:name,
					company_no:company_no,
          factory_key_id:factory_key_id,
					option:'insert',
					description:description,
					url:url,
					url_img:url_img,

        }	}	},
				function(data) {
					console.log(data);

				alert("결과:"+data.result+","+data.error);
				update_company_no();

				});


		});
