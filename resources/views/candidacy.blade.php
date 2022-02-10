<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>      
    <title>Laravel 8 Generate PDF From View</title>
    <!-- <link rel="stylesheet" href={{ asset('candidacy.css') }}> -->
    <style type="text/css">
        .candidacyContent{
            color: #000;
        }
        .candidacyHeader{
            width: 100vw;
            display: flex;
            background: green !important;
        }
        .candidacyText{
            font-weight: bold;
            text-align: center;
            float: left;
        }
        .candidacyText p{
            margin-top: -10px;
        }
        .candidacyLogo img{
            width: 150px;
            height: 80px;
            float: right;
        }
        .candidatePart{
            margin-top: 10rem;
        }
        fieldset{
            border: 1px solid #000;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            padding: 1rem;
        }
        #choices p:nth-child(1){
            margin-top: -1px
        }
        #choices p:nth-child(2){
            margin-top: -15px;
        }
        #choices p:nth-child(3){
            margin-top: -15px;
            margin-bottom: -5px;
        }
        .administrationContent table{
            border-collapse: collapse;
            width: 100%;
        }
        .administrationContent table td, .administrationContent table th{
            border: 1px solid #000;
            padding: 8px;
        }
    </style>
</head>
<body>
    <div class="candidacyContent">
        <div class="candidacyHeader">
            <div class="candidacyText">
                <p>Ministry of Higher Education and</p>
                <p>Scientific Research</p>
                <p class="stars">***</p>
                <p>University of sfax</p>
                <p>National Engineering School of Sfax</p>
            </div>
            <div class="candidacyLogo">
                <img src="{{ asset('images//client/logo.png') }}" alt="university_logo">
            </div>
        </div>
        <div class="candidatePart">
            <div class="firstSTep">
                <p style="float: left">File N °: <small>{{$candidacy->id}}/{{$candidacy->created_at}}</small></p>
                <p style="float: right">Last Date Modified: <small>{{$candidacy->updated_at}}</small></p>
            </div>
            <fieldset style="margin-top: 3rem">
                <legend>Choices</legend>
                <div id="choices">
                    @foreach ($choices as $choice)
                        <p>Choice {{$choice->choice}} : &nbsp;&nbsp;<b>{{$choice->masterTitle}}</b></p>
                    @endforeach
                </div>
            </fieldset>

            <fieldset>
                <legend>Personal Information</legend>
                <div>
                    <div style="margin-top: -15px;">
                        <p>National ID card or passport : &nbsp;&nbsp;<b>{{$candidacy->identity}}</b></p>
                    </div>
                    <div style="display: flex; margin-top: -12px;">
                        <p>Firstname : &nbsp;&nbsp;<b>{{$candidacy->firstName}}</b></p>
                        <p style="margin-left: 200px;">Lastname : &nbsp;&nbsp;<b>{{$candidacy->lastName}}</b></p>
                        <p style="margin-left: 400px;">Maiden Name : &nbsp;&nbsp;<b>{{$candidacy->maidenName}}</b></p>
                    </div>
                    <div style="display: flex; margin-top: -99px;">
                        <p>Date Of Birth : &nbsp;&nbsp;<b>{{$candidacy->dateOfBirth}}</b></p>
                        <p style="margin-left: 400px;">Place Of Birth : &nbsp;&nbsp;<b>{{$candidacy->placeOfBirth}}</b></p>
                    </div>
                    <div style="display: flex; margin-top: -64px; margin-bottom: -70px">
                        <p>Nationality : &nbsp;&nbsp;<b>{{$candidacy->nationality}}</b></p>
                        <p style="margin-left: 400px;">Gender : &nbsp;&nbsp;<b>{{$candidacy->gender}}</b></p>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Student Location</legend>
                <div>
                    <div style="margin-top: -15px;">
                        <p>Address : &nbsp;&nbsp;<b>{{$candidacy->address}}</b></p>
                    </div>
                    <div style="display: flex; margin-top: -15px;">
                        <p>Country : &nbsp;&nbsp;<b>{{$candidacy->country}}</b></p>
                        <p style="margin-left: 200px;">Government : &nbsp;&nbsp;<b>{{$candidacy->government}}</b></p>
                        <p style="margin-left: 500px;">City : &nbsp;&nbsp;<b>{{$candidacy->city}}</b></p>
                    </div>
                    <div style="display: flex; margin-top: -100px; margin-bottom: -105px">
                        <p>Postal Code : &nbsp;&nbsp;<b>{{$candidacy->postalCode}}</b></p>
                        <p style="margin-left: 200px;">E-mail : &nbsp;&nbsp;<b>{{$candidacy->email}}</b></p>
                        <p style="margin-left: 500px;">Phone : &nbsp;&nbsp;<b>{{$candidacy->phone}}</b></p>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Studies</legend>
                <div>
                    <div style="display: flex;">
                        <p>Baccalaureate Year : &nbsp;&nbsp;<b>{{$study->baccalaureateYear}}</b></p>
                        <p style="margin-left: 350px;">Baccalaureate Average : &nbsp;&nbsp;<b>{{$study->baccalaureateAverage}}</b></p>
                    </div>
                    <div style="display: flex; margin-top: -65px;">
                        <p style="width: 50%;">Establishment : &nbsp;&nbsp;<b>{{$study->otherEstablishment ? $study->otherEstablishment : $study->establishmentTitle}}</b></p>
                        <p style="margin-left: 350px;">Speciality : &nbsp;&nbsp;<b>{{$study->otherSpeciality ? $study->otherSpeciality : $study->specialityTitle}}</b></p>
                    </div>
                    <div style="display: flex; margin-top: -63px;">
                        <p>Diploma : &nbsp;&nbsp;<b>{{$study->diploma->name}}</b></p>
                        <p style="margin-left: 350px;">Year Of Graduation : &nbsp;&nbsp;<b>{{$study->yearOfGraduation}}</b></p>
                    </div>
                    <div style="display: flex; margin-top: -63px;">
                        <p>Professional Situation : &nbsp;&nbsp;<b>{{$study->professionalSituation}}</b></p>
                        <p style="margin-left: 350px;">Number Of Internships : &nbsp;&nbsp;<b>{{$study->numberOfInternships}}</b></p>
                    </div>
                    <div style="display: flex; margin-top: -63px;">
                        <p>Number Of Registration With Drawals : &nbsp;&nbsp;<b>{{$study->nbOfRegistrationWithdrawals}}</b></p>
                        <p style="margin-left: 350px;">Number Of Repetitions From Baccalaureate : &nbsp;&nbsp;<b>{{$study->nbOfRepetitionsFromBaccalaureate}}</b></p>
                    </div>
                    <div style="display: flex; margin-top: -63px; margin-bottom: -70px">
                        <p>Preparatory ? &nbsp;&nbsp;<b>{{$study->preparatory === 1 ? 'Yes' : 'No'}}</b></p>
                        @if ($study->preparatory)
                            <p style="margin-left: 350px;">Number Of Repetitions In Preparatory : &nbsp;&nbsp;<b>{{$study->nbOfRepetitionsInPreparatory}}</b></p>
                        @endif
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Higher Studies</legend>
                <table style="font-size: 12px; text-align: center;">
                    <thead style="background: #dfe6e9">
                        <tr>
                            <th>School Year</th>
                            <th>Level</th>
                            <th>Establishment</th>
                            <th>Continuing Studies</th>
                            <th>Mean</th>
                            <th>Redouble</th>
                            @if ($study->diploma->credits)
                                <th>Credit</th>
                            @endif
                            <th>Mention</th>
                            <th>Session</th>
                        </tr>
                    </thead>

                    <tbody style="height: 300px">
                        @if ($higherStudies)
                            @foreach ($higherStudies as $higherStudy)
                                <tr>
                                    <td>{{ $higherStudy->schoolYear }}</td>
                                    <td>{{ $higherStudy->level }}</td>
                                    <td>{{ $higherStudy->otherEstablishment ? $higherStudy->otherEstablishment : $higherStudy->establishmentTitle }}</td>
                                    <td>{{ $higherStudy->continuingStudies }}</td>
                                    <td>{{ $higherStudy->mean }}</td>
                                    <td>{{ $higherStudy->redouble }}</td>
                                    @if ($study->diploma->credits)
                                        <td>{{ $higherStudy->credit }}</td>
                                    @endif
                                    <td>{{ $higherStudy->mention }}</td>
                                    <td>{{ $higherStudy->session }}</td>

                                </tr>
                            @endforeach   
                        @else
                            <tr>
                                <td colspan="5">no records found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </fieldset>
            @if ($study->diploma->sfe)
                <fieldset>
                    <legend>SFE note</legend>
                    <p style="margin-top: -1px; margin-bottom: -1px"><span>Semester 1 :</span> &nbsp;&nbsp;<b>{{ $candidacy->sfe }}</b></p>
                </fieldset>
            @endif
            <div style="page-break-after: always;"></div>
            <fieldset>
                <legend>Signature</legend>
                <p>I certify the accuracy of all the information contained in my application file.</p>
                <p>AT……………………………… . The………………………………</p>
                <p>I Certify that all the data mentioned above is correct and I assume my full responsibility for any error that has infiltrated.</p>
                <p>NB: Any mistake in entering data systematically results in the elimination of the application file.</p><br>
                <p>Signature</p>
                <p>………………………………</p>
            </fieldset>
        </div>
        <div class="administrationPart">
            <h2 style="text-align:center; margin-top: 5rem">Reserved for administration</h2>
            <div class="administrationContent">
                <h3>Decision</h3>
                <table>
                    <thead>
                        <tr>
                            <th colspan="2" style="width: 50%">First year master's commission</th>
                            <th style="width: 50%">Members of the jury</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>Accepted</p>
                                <p>Refused</p>
                                <p>Pending</p>
                            </td>
                            <td>Note:</td>
                            <td></td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>