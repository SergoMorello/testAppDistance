$( function() {
	autocompleteInput();
	btnDistance();
});

function btnDistance() {
	var modal = $('#exampleModal');
	var modalTitle = modal.find('.modal-title');
	var modalBody = modal.find('.modal-body');

	$("#getDistance").on("submit",function(){
		var btn = $(this).find('[type="submit"]');
		var btnSpinner = btn.find('#spinner');
		btn.attr('disabled',true);
		btnSpinner.show();
		var options = {
			method: "POST",
			body: new FormData(this)
		}
	
		fetch('/api/submit', options)
		.then(e => e.json())
		.then(result => {
			modalTitle.text("Расстояние до "+result.adrTo);
			modalBody.text(result.distance+" Км");
			var myModal = new bootstrap.Modal(modal);
			myModal.show();
			btn.attr('disabled',false);
			btnSpinner.hide();
		})
		.catch(error => console.log("error", error));
		return false;
	});
	
}

function autocompleteInput() {
	$( ".autocompleteJs" ).autocomplete({
		source: function( request, response ) {
			
			var options = {
				method: "POST",
				body: new URLSearchParams({
					'query': request.term
				})
			}

			fetch('/api/autocomplete', options)
			.then(e => e.json())
			.then(result => {
				response(result);
			})
			.catch(error => console.log("error", error));
		},
		select: function( event, ui ) {
			var geo_lat = ui.item.data.geo_lat ?? 0;
			var geo_lon = ui.item.data.geo_lon ?? 0;

			$("#adr_lat").val(geo_lat);
			$("#adr_lon").val(geo_lon);
		},
		search: function( event, ui ) {
			$("#adr_lat").val(0);
			$("#adr_lon").val(0);
		}
	  });
}