<div class="modal-dialog modal-confirm">
	<div class="modal-content">
		<div class="modal-header justify-content-center">
			<div class="icon-box">
				<i class="ri-close-line"></i>
			</div>
			<button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
		</div>
		<div class="modal-body text-center">
			<h4>Ooops!</h4>	
			<p>Are you sure you want to delete the Academic Year  <strong>{{$AD_year->name}}? </strong></p>
			<a href="{{route('AcadmicY.deleteADyear',$AD_year->id)}}"> <button type="button" class="btn btn-danger"><i class="fa fa-trash">Confirm</i></button></a>
			

		</div>
	</div>
</div> 