@extends('alumni')

@section('content')
  <div class="container-fluid">
  <div class="row">
  @if($status == 0)

    <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Record cannot be added. Student number already exists.
      </div>

  @elseif($status == 2)

    <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Graduate record successfully added.
      </div>

  @endif
    <form class="cd-form floating-labels" action="{{ url('/processAddGraduate') }}" method="post">
  @if($errors->any())
    <ul class="alert alert-danger">
      <strong>Oops!</strong>
        @foreach ($errors->all() as $error)
          <li>&bull;{{ $error }}</li>
        @endforeach
    </ul>
  @endif
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <legend><h2>Add a Graduate Record</h2></legend>
    <p> Fields marked with <span class="required">*</span> are mandatory.</p>
     
      <fieldset>
        <legend><i class="fa fa-user"></i> Personal Information</legend>

        <div class="form-group col-md-3">
          <label for="studnum" ><h4>Student Number <span class="required">*</span></h4></label>
          <input type="text" class="form-control" id="studnum" name="studnum" placeholder="xxxx-xxxxx" >
        </div>

        <div class="form-group col-md-12">
          <label for="fname"><h4>First Name <span class="required">*</span></h4></label>
          <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" >
        </div>

        <div class="form-group col-md-12">
          <label for="mname"><h4>Middle Name <span class="required">*</span></h4></label>
          <input type="text" class="form-control" id="mname" name="mname" placeholder="Middle Name" >
        </div>

        <div class="form-group col-md-12" >
          <label for="lname"><h4>Last Name <span class="required">*</span></h4></label>
          <input type="text" class="form-control" name="lname" placeholder="Last Name" >
        </div>

        <div class="form-group col-md-12" >
          <label for="lname"><h4>Suffix</h4></label>
          <input type="text" class="form-control" name="suffix" placeholder="Suffix" >
        </div>

        <div class="form-group col-md-6">
          <label for="bday"><h4>Birth Date <span class="required">*</span></h4></label>
          <input type="date" class="form-control" id="bday" name="bday" >
        </div>

        <div class="form-group col-md-6 cd-select">
          <label for="sex"><h4>Sex <span class="required">*</span></h4></label><br>
            <select name="sex" id="sex" required>
                      <option value ="" disabled selected>Sex</option>
                      <option name="Female" value="Female">Female</option>
                      <option name="Male" value="Male">Male</option>
                    </select>
        </div>


      </fieldset>

      <fieldset>
        <legend><i class="fa fa-map-marker"></i> Contact Information</legend>

        <div class="form-group col-md-12">
          <label for="contactnum" ><h4>Contact Number <span class="required">*</span></h4></label>
          <input type="text" class="form-control" id="contactnum" name="contactnum" placeholder="Contact Number" >
        </div>

        <div class="form-group col-md-12">
          <label for="permaddress"><h4>Permanent Address <span class="required">*</span></h4></label>
          <textarea name="permaddress" id="permaddress" ></textarea>
        </div>

        <div class="form-group col-md-12">
          <label for="curraddress"><h4>Current Address <span class="required">*</span></h4></label>
          <textarea name="curraddress" id="curraddress" placeholder="Kindly type 'N/A' if same as permanent address." ></textarea>
        </div>

      </fieldset>

      <fieldset>
        <legend><i class="fa fa-graduation-cap"></i> Academic Background</legend>

        <div class="form-group cd-select col-md-12">
          <label for="contactnum" ><h4>Major <span class="required">*</span></h4></label>
          <select name = "major" >
            <option value="" disabled selected>Major</option>
            <option value="Cell and Molecular Biology">Cell and Molecular Biology</option>
            <option value="Ecology">Ecology</option>
            <option value="Genetics">Genetics</option>
            <option value="Microbiology">Microbiology</option>
            <option value="Plant Biology">Plant Biology</option>
            <option value="Systematics">Systematics</option>
            <option value="Wildlife Biology">Wildlife Biology</option>
            <option value="Zoology">Zoology</option>
          </select>
        </div>

        <div class="form-group cd-select col-md-12">
          <label for="permaddress"><h4>Master of Science Degree <span class="required">*</span></h4></label>
          <select name="mscdegree" >
            <option value="" disabled selected>M.Sc. Degree</option>
            <option value="N/A">Not Applicable</option>
            <option value="Botany">Botany</option>
            <option value="Genetics">Genetics</option>
            <option value="Microbiology">Microbiology</option>
            <option value="Molecular Biology and Biotechnology">Molecular Biology and Biotechnology</option>
            <option value="Wildlife Studies">Wildlife Studies</option>
            <option value="Zoology">Zoology</option>
          </select>
        </div>

        <div class="form-group col-md-12">
          <label for="yeargrad"><h4>Year Graduated <span class="required">*</span></h4></label>
          <input type="text" class="form-control" id="yeargrad" name="yeargrad" placeholder="Year Graduated" >
        </div>

        <div class="form-group col-md-12">
          <label for="honorsreceived"><h4>Honors and Awards Received <span class="required">*</span></h4></label>
          <textarea name="honorsreceived" id="honorsreceived"></textarea>
        </div>

      </fieldset>

      <fieldset>
        <legend><i class="fa fa-briefcase"></i> Work Information</legend>

        <div class="form-group col-md-12">
          <label for="company" ><h4>Name of Company/Institution <span class="required">*</span></h4></label>
          <input type="text" class="form-control" id="companyname" name="companyname" placeholder="Name of Company/Insitution" >
        </div>

        <div class="form-group col-md-12">
          <label for="position"><h4> Current Position <span class="required">*</span></h4></label>
          <input type="text" class="form-control" id="position" name="position" placeholder="Position" >
        </div>

        <div class="form-group col-md-12">
          <label for="natureofwork"><h4>Nature of Work <span class="required">*</span></h4></label>
          <input type="text" class="form-control" id="natureofwork" name="natureofwork" placeholder="Position" >
        </div>

        <div class="form-group col-md-12">
          <label for="companyaddress"><h4>Address <span class="required">*</span></h4></label>
          <textarea name="companyaddress" id="companyaddress" ></textarea>
        </div>

        <div class="form-group col-md-12">
          <label for="country"><h4>Country <span class="required">*</span></h4></label>
          <input type="text" class="form-control" id="country" name="country" placeholder="Country" >
        </div>

         <div class="form-group col-md-12">
          <label for="companyemail"><h4>Email Address <span class="required">*</span></h4></label>
          <input type="text" class="form-control" id="companyemail" name="companyemail" placeholder="Email Address" >
        </div>

        <div class="form-group col-md-12">
          <label for="companycontactnum"><h4>Contact Number <span class="required">*</span></h4></label>
          <input type="text" class="form-control" id="companycontactnum" name="companycontactnum" placeholder="Contact Number" >
        </div>



      </fieldset>
    

      <div class="row mt20">
        <div class="col-md-12">
          <div class="pull-right">
            <button class="action-btn" type="submit">
              <i class="fa fa-user-plus"></i> Add Record
            </button>
          </div>
        </div>
      </div>
  </form>


</div>
</div>


@endsection