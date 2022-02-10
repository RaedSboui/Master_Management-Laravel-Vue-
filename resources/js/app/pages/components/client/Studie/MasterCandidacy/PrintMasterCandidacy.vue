<template>
    <div class="candidacyContent">
        <div class="candidacyHeader">
            <div class="candidacyText">
                <p>Ministry of Higher Education and</p>
                <p>Scientific Research</p>
                <p>***</p>
                <p>University of sfax</p>
                <p>National Engineering School of Sfax</p>
            </div>
            <div class="candidacyLogo">
                <img src="/images/client/logo.png" alt="university_logo">
            </div>
        </div>
        <div class="candidatePart">
            <div class="firstSTep">
                <p>File N °: <small>{{candidacy.id}}/{{candidacy.created_at}}</small></p>
                <p>Last Date Modified: <small>{{candidacy.updated_at}}</small></p>
            </div>
            <fieldset>
                <legend class="ml-4">Choices</legend>
                <div class="" v-for="(choice, index) in choices" :key="index">
                    <p>Choice {{choice.choice}} : &nbsp;&nbsp;<b>{{choice.master}}</b></p>
                </div>
            </fieldset>
            <fieldset>
                <legend class="ml-4">Personal Information</legend>
                <div class="p-field ml-3">
                    <div class="col-12">
                        <p>National ID card or passport : &nbsp;&nbsp;<b>{{candidacy.identity}}</b></p>
                    </div>
                    <div class="flex">
                        <p class="col-3">Firstname : &nbsp;&nbsp;<b>{{candidacy.firstName}}</b></p>
                        <p class="col-3">Lastname : &nbsp;&nbsp;<b>{{candidacy.lastName}}</b></p>
                        <p class="col-3">Maiden Name : &nbsp;&nbsp;<b>{{candidacy.maidenName}}</b></p>
                    </div>
                    <div class="flex">
                        <p class="col-6">Date Of Birth : &nbsp;&nbsp;<b>{{candidacy.dateOfBirth}}</b></p>
                        <p class="col-6">Place Of Birth : &nbsp;&nbsp;<b>{{candidacy.placeOfBirth}}</b></p>
                    </div>
                    <div class="flex">
                        <p class="col-6">Nationality : &nbsp;&nbsp;<b>{{candidacy.nationality}}</b></p>
                        <p class="col-6">Gender : &nbsp;&nbsp;<b>{{candidacy.gender}}</b></p>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend class="ml-4">Student Location</legend>
                <div class="p-field ml-3">
                    <div class="col-12">
                        <p>Address : &nbsp;&nbsp;<b>{{candidacy.address}}</b></p>
                    </div>
                    <div class="flex">
                        <p class="col-3">Country : &nbsp;&nbsp;<b>{{candidacy.country}}</b></p>
                        <p class="col-3">Government : &nbsp;&nbsp;<b>{{candidacy.government}}</b></p>
                        <p class="col-3">City : &nbsp;&nbsp;<b>{{candidacy.city}}</b></p>
                    </div>
                    <div class="flex">
                        <p class="col-3">Postal Code : &nbsp;&nbsp;<b>{{candidacy.postalCode}}</b></p>
                        <p class="col-3">E-mail : &nbsp;&nbsp;<b>{{candidacy.email}}</b></p>
                        <p class="col-3">Phone : &nbsp;&nbsp;<b>{{candidacy.phone}}</b></p>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend class="ml-4">Studies</legend>
                <div class="p-field ml-3">
                    <div class="flex">
                        <p class="col-6">Baccalaureate Year : &nbsp;&nbsp;<b>{{studies?.baccalaureateYear}}</b></p>
                        <p class="col-6">Baccalaureate Average : &nbsp;&nbsp;<b>{{studies?.baccalaureateAverage}}</b></p>
                    </div>
                    <div class="flex">
                        <p class="col-6">Establishment : &nbsp;&nbsp;<b>{{studies?.establishment_id}}</b></p>
                        <p class="col-6">Speciality : &nbsp;&nbsp;<b>{{studies?.speciality_id}}</b></p>
                    </div>
                    <div class="flex">
                        <p class="col-6">Diploma : &nbsp;&nbsp;<b>{{studies?.diploma_id}}</b></p>
                        <p class="col-6">Year Of Graduation : &nbsp;&nbsp;<b>{{studies?.yearOfGraduation}}</b></p>
                    </div>
                    <div class="flex">
                        <p class="col-6">Professional Situation : &nbsp;&nbsp;<b>{{studies?.professionalSituation}}</b></p>
                        <p class="col-6">Number Of Internships : &nbsp;&nbsp;<b>{{studies?.numberOfInternships}}</b></p>
                    </div>
                    <div class="flex">
                        <p class="col-6">Number Of Registration With Drawals : &nbsp;&nbsp;<b>{{studies?.nbOfRegistrationWithdrawals}}</b></p>
                        <p class="col-6">Number Of Repetitions From Baccalaureate : &nbsp;&nbsp;<b>{{studies?.nbOfRepetitionsFromBaccalaureate}}</b></p>
                    </div>
                    <div class="flex">
                        <p class="col-6">Preparatory ? &nbsp;&nbsp;<b>{{studies?.preparatory}}</b></p>
                        <p class="col-6">Number Of Repetitions In Preparatory : &nbsp;&nbsp;<b>{{studies?.nbOfRepetitionsInPreparatory}}</b></p>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend class="ml-4">Higher Studies</legend>
                <DataTable :value="higherStudies" responsiveLayout="scroll">
                    <Column field="schoolYear" header="School Year">
                        <template #body="slotProps">
				            {{slotProps.data.schoolYear}}
			            </template>
                    </Column>
                    <Column field="level" header="Level">
                        <template #body="slotProps">
				            {{slotProps.data.level}}
			            </template>
                    </Column>
                    <Column field="establishment" header="Establishment">
                        <template #body="slotProps">
                            {{ slotProps.data }}
			            </template>
                    </Column>
                    <Column field="continuingStudies" header="Continuing Studies">
                        <template #body="slotProps">
				            {{slotProps.data.continuingStudies}}
			            </template>
                    </Column>
                    <Column field="mean" header="Mean">
                        <template #body="slotProps">
				            {{slotProps.data.mean}}
			            </template>
                    </Column>
                    <Column field="redouble" header="Redouble">
                        <template #body="slotProps">
				            {{slotProps.data.redouble}}
			            </template>
                    </Column>
                    <Column field="credit" header="Credit" v-if="studies?.diploma_id">
                        <template #body="slotProps">
				            {{slotProps.data.credit}}
			            </template>
                    </Column>
                    <Column field="mention" header="Mention">
                        <template #body="slotProps">
				            {{slotProps.data.mention}}
			            </template>
                    </Column>
                    <Column field="session" header="Session">
                        <template #body="slotProps">
				            {{slotProps.data.session}}
			            </template>
                    </Column>
                </DataTable>
            </fieldset>
            <fieldset>
                <legend class="ml-4">SFE note</legend>
                <p><span class="sfeNote">Semester 1 :</span> &nbsp;&nbsp;<b>{{candidacy.sfe}}</b></p>
            </fieldset>
            <fieldset>
                <legend class="ml-4">Signature</legend>
                <p>I certify the accuracy of all the information contained in my application file.</p><br>
                <p>AT………………………………. The………………………………</p>
                <p>I Certify that all the data mentioned above is correct and I assume my full responsibility for any error that has infiltrated.</p><br>
                <p>NB: Any mistake in entering data systematically results in the elimination of the application file.</p><br>
                <p>Signature</p><br>
                <p>………………………………</p>
            </fieldset>
        </div>
        <div class="administrationPart">
            <h2>Reserved for administration</h2>
            <div class="administrationContent">
                <h5>Decision</h5>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            candidacy: {
                id: 1,
                firstName: "Raed",
                lastName: "SBOUI",
                created_at: "2021/12/30",
                updated_at: "2021-12-27 11:15:19"
            },
            choice:{
                choice: 1,
                master: "info"
            }
        };
    }
}
</script>

<style lang="scss">
.candidacyContent{
    color: #000;
    margin: 1rem;
    border: 1px solid #000;
    padding: 2rem;
    .candidacyHeader{
        display: flex;
        align-items: center;
        justify-content: space-between;

        .candidacyText{
            text-align: center;
        }
        .candidacyLogo{
            img{
                width: 200px;
            }
        }
    }
    .candidatePart{
        margin-top: 5rem;
        p{
            font-weight: bold;

            small{
                font-weight: 500;
            }
        }
        .firstSTep{
            display: flex;
            justify-content: space-between;
        }
        fieldset{border: 1px solid #000}
    }
}
</style>