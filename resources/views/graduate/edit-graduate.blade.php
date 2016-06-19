@extends('alumni')

@section('content')
	<div class="container-fluid">

	@if($status)

		<div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Successfully edited the record!
    	</div>

	@endif

	<div class="row">	
	<form class="cd-form floating-labels" action="{{ url('/processEditGraduate') }}" method="post">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">	
	<input type="hidden" name="studnum" id="studnum" value="{{$graduate[0]->studnum}}">
		
		<fieldset>
        <legend><i class="fa fa-user"></i> Personal Information</legend>

        <div class="form-group col-md-3">
          <label for="studnum" ><h4>Student Number <span class="required">*</span></h4></label>
          <input type="text" class="form-control" value="{{$graduate[0]->studnum}}"id="studnum" name="studnum" placeholder="xxxx-xxxxx" disabled>
        </div>

        <div class="form-group col-md-12">
          <label for="fname"><h4>First Name <span class="required">*</span></h4></label>
          <input type="text" class="form-control" value="{{$graduate[0]->fname}}" id="fname" name="fname" placeholder="First Name" >
        </div>

        <div class="form-group col-md-12">
          <label for="mname"><h4>Middle Name <span class="required">*</span></h4></label>
          <input type="text" class="form-control" value="{{$graduate[0]->mname}}" id="mname" name="mname" placeholder="Middle Name" >
        </div>

        <div class="form-group col-md-12">
          <label for="lname"><h4>Last Name <span class="required">*</span></h4></label>
          <input type="text" class="form-control" value="{{$graduate[0]->lname}}" id="lname" name="lname" placeholder="Last Name" >
        </div>

         <div class="form-group col-md-12" >
          <label for="lname"><h4>Suffix</h4></label>
          <input type="text" class="form-control" value="{{$graduate[0]->suffix}}" name="suffix" placeholder="Suffix" >
        </div>

        <div class="form-group col-md-6">
          <label for="bday"><h4>Birth Date <span class="required">*</span></h4></label>
          <input type="date" class="form-control" value="{{$graduate[0]->bday}}" id="bday" name="bday" >
        </div>

        <div class="form-group col-md-6 cd-select">
          <label for="sex"><h4>Sex <span class="required">*</span></h4></label><br>
            <select name="sex" id="sex" required>
                      <option value ="" disabled>Sex</option>
                      <option name="Female" value="Female" <?php if ($graduate[0]->sex=='Female'){echo 'selected';}?>>Female</option>
                      <option name="Male" value="Male" <?php if ($graduate[0]->sex=='Male'){echo 'selected';}?>>Male</option>
                    </select>
        </div>


      </fieldset>

      <fieldset>
        <legend><i class="fa fa-map-marker"></i> Contact Information</legend>

        <div class="form-group col-md-12">
          <label for="contactnum" ><h4>Contact Number <span class="required">*</span></h4></label>
          <input type="text" class="form-control" id="contactnum" name="contactnum" value="{{$graduate[0]->contactnum}}" placeholder="Contact Number" >
        </div>

        <div class="form-group col-md-12">
          <label for="permaddress"><h4>Permanent Address <span class="required">*</span></h4></label>
          <textarea name="permaddress" id="permaddress" >{{$graduate[0]->permaddress}}</textarea>
        </div>

        <div class="form-group col-md-12">
          <label for="curraddress"><h4>Current Address <span class="required">*</span></h4></label>
          <textarea name="curraddress" id="curraddress" placeholder="Kindly type 'N/A' if same as permanent address." >{{$graduate[0]->curraddress}}</textarea>
        </div>

      </fieldset>

      <fieldset>
        <legend><i class="fa fa-graduation-cap"></i> Academic Background</legend>

        <div class="form-group cd-select col-md-12">
          <label for="major" ><h4>Major <span class="required">*</span></h4></label>
          <select name = "major">
            <option value="" disabled selected>Major</option>
            <option value="Cell and Molecular Biology" <?php if ($graduate[0]->major=='Cell and Molecular Biology'){echo 'selected';}?>>Cell and Molecular Biology</option>
            <option value="Ecology" <?php if ($graduate[0]->major=='Ecology'){echo 'selected';}?>>Ecology</option>
            <option value="Genetics" <?php if ($graduate[0]->major=='Genetics'){echo 'selected';}?>>Genetics</option>
            <option value="Microbiology" <?php if ($graduate[0]->major=='Microbiology'){echo 'selected';}?>>Microbiology</option>
            <option value="Plant Biology" <?php if ($graduate[0]->major=='Plant Biology'){echo 'selected';}?>>Plant Biology</option>
            <option value="Systematics" <?php if ($graduate[0]->major=='Systematics'){echo 'selected';}?>>Systematics</option>
            <option value="Wildlife" <?php if ($graduate[0]->major=='Wildlife Biology'){echo 'selected';}?>>Wildlife Biology</option>
            <option value="Zoology" <?php if ($graduate[0]->major=='Zoology'){echo 'selected';}?>>Zoology</option>
          </select>
        </div>

        <div class="form-group cd-select col-md-12">
          <label for="mscdegree"><h4>Master of Science Degree <span class="required">*</span></h4></label>
          <select name="mscdegree" >
            <option value="" disabled selected>M.Sc. Degree</option>
            <option value="N/A" <?php if ($graduate[0]->mscdegree=='N/A'){echo 'selected';}?>>Not Applicable</option>
            <option value="Botany" <?php if ($graduate[0]->mscdegree=='Botany'){echo 'selected';}?>>Botany</option>
            <option value="Genetics" <?php if ($graduate[0]->mscdegree=='Genetics'){echo 'selected';}?>>Genetics</option>
            <option value="Microbiology" <?php if ($graduate[0]->mscdegree=='Microbiology'){echo 'selected';}?>>Microbiology</option>
            <option value="Molecular Biology" <?php if ($graduate[0]->mscdegree=='Molecular Biology'){echo 'selected';}?>>Molecular Biology and Biotechnology</option>
            <option value="Wildlife Studies" <?php if ($graduate[0]->mscdegree=='Wildlife Studies'){echo 'selected';}?>>Wildlife Studies</option>
            <option value="Zoology" <?php if ($graduate[0]->mscdegree=='Zoology'){echo 'selected';}?>>Zoology</option>
          </select>
        </div>

        <div class="form-group col-md-12">
          <label for="yeargrad"><h4>Year Graduated <span class="required">*</span></h4></label>
          <input type="text" class="form-control" id="yeargrad" name="yeargrad" placeholder="Year Graduated" value="{{$graduate[0]->yeargrad}}">
        </div>

        <div class="form-group col-md-12">
          <label for="honorsreceived"><h4>Honors and Awards Received <span class="required">*</span></h4></label>
          <textarea name="honorsreceived" id="honorsreceived">{{$graduate[0]->honorsreceived}}</textarea>
        </div>

      </fieldset>

      <fieldset>
        <legend><i class="fa fa-briefcase"></i> Work Information</legend>

        <div class="form-group col-md-12">
          <label for="contactnum" ><h4>Name of Company/Institution <span class="required">*</span></h4></label>
          <input type="text" class="form-control" id="companyname" name="companyname" value="{{$graduate[0]->companyname}}"placeholder="Name of Company/Insitution" >
        </div>

        <div class="form-group col-md-12">
          <label for="permaddress"><h4>Current Position <span class="required">*</span></h4></label>
          <input type="text" class="form-control" id="position" name="position" value="{{$graduate[0]->position}}" placeholder="Position" >
        </div>

        <div class="form-group col-md-12">
          <label for="natureofwork"><h4>Nature of Work <span class="required">*</span></h4></label>
          <input type="text" class="form-control" id="natureofwork" name="natureofwork" value="{{$graduate[0]->natureofwork}}" placeholder="Position" >
        </div>

        <div class="form-group col-md-12">
          <label for="companyaddress"><h4>Address <span class="required">*</span></h4></label>
          <textarea name="companyaddress" id="companyaddress" >{{$graduate[0]->companyaddress}}</textarea>
        </div>

        <div class="form-group col-md-12">
          <label for="country"><h4>Country <span class="required">*</span></h4></label>
          <input type="text" class="form-control" id="country"  value="{{$graduate[0]->country}}" name="country" placeholder="Country" >
        </div>


         <div class="form-group col-md-12">
          <label for="companyemail"><h4>Email Address <span class="required">*</span></h4></label>
          <input type="text" class="form-control" id="companyemail" value="{{$graduate[0]->companyemail}}"name="companyemail" placeholder="Email Address" >
        </div>

        <div class="form-group col-md-12">
          <label for="companycontactnum"><h4>Contact Number <span class="required">*</span></h4></label>
          <input type="text" class="form-control" id="companycontactnum" value="{{$graduate[0]->companycontactnum}}" name="companycontactnum" placeholder="Contact Number" >
        </div>



      </fieldset>
    

	      <div class="row mt20">
	        <div class="col-md-12">
	          <div class="pull-right">
	            <button class="action-btn" type="submit">
	              <i class="fa fa-pencil-square-o"></i> Save
	            </button>
	          </div>
	        </div>
	      </div>
  		</form>
	</div>
</div>
@endsection