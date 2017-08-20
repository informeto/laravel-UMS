     $(document).ready(function() {
        var max_fields      = 5; //maximum input boxes allowed
        var wrapper         = $("#education_fields"); //Fields wrapper
        var add_button      = $("#add_field_button"); //Add button ID
        
        $.validate({
               modules : 'date,location', 
               onModulesLoaded : function() {$('#id_nationality').suggestCountry();$('#id_country').suggestCountry();},
          });
        
        
        var education_fields = 0; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(education_fields < max_fields){ //max input box allowed
                education_fields++; //text box increment
                $(wrapper).append('<div class="col-md-10">\n\
                                    <input class="input-md textinput textInput form-control requiredField" name="edegree[]"  placeholder="Degree" style="margin-bottom: 10px" type="text" data-validation="length" data-validation-length="2-50" data-validation-error-msg="Please enter a degree name."/>\n\
                                    <input class="input-md textinput textInput form-control requiredField" name="einstitute[]"  placeholder="Institution Name" style="margin-bottom: 10px" type="text" data-validation="length" data-validation-length="2-100" data-validation-error-msg="Please enter institution\'s name."/>\n\
                                    <input class="input-md textinput textInput form-control requiredField" name="eyear[]"  placeholder="Year of completion" style="margin-bottom: 10px" type="text" data-validation="birthdate" data-validation-format="yyyy" data-validation-error-msg="Please enter valid year of completion."/>\n\
                                    <a href="#" class="remove_field">Remove</a>\n\
                                  </div>'); 
                
                if(education_fields == max_fields){
                    $(add_button).hide();
                }
                
                $.validate();
            }
        });

        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); 
            $(this).parent('div').remove(); 
            education_fields--;
            $(add_button).show();
        });
        
        registration_form = $('#register-form');
        registration_form.on('submit', function(e) { //use on if jQuery 1.7+
            e.preventDefault();  //prevent form from submitting
            var data = registration_form.serializeArray();
            userData = parseSubmit(data);
            
            if(userData._token && verify_form_completion(userData)){
                register(userData);
            }
            
            return false;
        });
        
        parseSubmit = function(formData){
            console.log(formData);
            education_raw = { degrees:[], years:[], institutes:[] };
            var name,email,phone,pref_comm, gender,dob,nationality,address={},csrftoken;
            for(i=0; i<formData.length;i++){
                inputData = formData[i];
                inputData.value = inputData.value.trim();
                switch(inputData.name){
                    case '_token':
                        csrftoken = inputData.value;
                        break;
                        
                    case 'name':
                        name = inputData.value;
                        break;
                        
                    case 'email':
                        email = inputData.value;
                        break;
                        
                    case 'address':
                        address = inputData.value;
                        break;
                        
                    case 'number':
                        phone = inputData.value;
                        break;
                    
                    case 'pref_comm':
                        pref_comm = inputData.value;
                        break;
                    
                    case 'gender':
                        gender = inputData.value;
                        break;
                    
                    case 'birthdate':
                        dob = inputData.value;
                        break;
                    
                    case 'nationality':
                        nationality = inputData.value;
                        break;
                        
                    case 'edegree[]':
                        education_raw.degrees.push(inputData.value);
                        break;
                        
                    case 'eyear[]':
                        education_raw.years.push(inputData.value);
                        break;
                        
                    case 'einstitute[]':
                        education_raw.institutes.push(inputData.value);
                        break;
                        
                    case 'address-line1':
                        address.line1 = inputData.value;
                        break;
                        
                    case 'address-line2':
                        address.line2 = inputData.value;
                        break;
                        
                    case 'city':
                        address.city = inputData.value;
                        break;
                        
                     case 'region':
                        address.region = inputData.value;
                        break;
                        
                    case 'postal-code':
                        address.zip = inputData.value;
                        break;
                        
                    case 'country':
                        address.country = inputData.value;
                        break;
                        
                    default:
                        break;
                }
                
                
            }
            education = [];
            
            for(e=0;e<education_raw.degrees.length;e++){
                degree = education_raw.degrees[e];
                institute = education_raw.institutes[e];
                year = education_raw.years[e];
                if( degree && institute && year){
                    eData = { 'degree' : degree,'institute':institute, 'year': year };
                    education.push(eData);
                }
            }
            
            return {
                _token: csrftoken,
                name : name,
                email : email,
                phone : phone,
                pref_comm: pref_comm,
                gender : gender,
                dob : dob,
                nationality : nationality,
                address: address,
                education : education
            };
        };
        
        verify_form_completion = function(userData){
            if(!userData.name || !userData.email || !userData.phone || !userData.gender || !userData.dob || !userData.nationality)
                return;
            
            if(userData.education && userData.education.length < education_fields)
                return;
            
            if(userData.address && (!userData.address.line1 || !userData.address.city || !userData.address.region || !userData.address.zip || !userData.address.country))
                return;
            
            return true;
        };
        
        
        register = function(regData){
            $.post("register",regData, function(response){
                response = JSON.parse(response);
                if(response.success){
                    toastr.success('Registered successfully');
                    document.getElementById('register-form').reset();
                } else if(response.error){
                    toastr.error(response.error);
                }
            });
        };
          
          
        
 });
