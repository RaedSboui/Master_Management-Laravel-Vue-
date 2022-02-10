import { createStore } from "vuex";

const store = createStore({
    state: {
        token: localStorage.getItem('auth') || '',
        user: JSON.parse(localStorage.getItem('user')) || '',
        candidate: JSON.parse(localStorage.getItem('candidate')) || '',
        candidacyId: localStorage.getItem('candidacyId') || '',

        choices: '',
        candidacy: '',
        studies: '',
        higherStudies: '',
        masterCredentials: ''
    },
    mutations: {
        setToken(state, token) {
            localStorage.setItem('auth', token)
            state.token = token;
        },
        clearToken(state) {
            localStorage.removeItem('auth')
            state.token =''
        },

        setUser(state, user) {
            localStorage.setItem('user', JSON.stringify(user))
            state.user = user;
        },
        clearUser(state) {
            localStorage.removeItem('user')
            state.user =''
        },

        setCandidate(state, candidate){
            localStorage.setItem('candidate', JSON.stringify(candidate))
            state.candidate = candidate
        },
        clearCandidate(state) {
            localStorage.removeItem('candidate')
            state.candidate =''
        },
        setCandidacy(state, candidacyId){
            localStorage.setItem('candidacyId', candidacyId)
            state.candidacyId = candidacyId
        },
        clearCandidacy(state) {
            localStorage.removeItem('candidacyId')
            state.candidacyId =''
        },

        //Candidacy Data
        setChoices(state, choices){
            state.choices = choices
        },
        clearChoices(state) {
            state.choices = ''
        },
        setCandidacyData(state, candidacy){
            state.candidacy = candidacy
        },
        clearCandidacyData(state) {
            state.candidacy = ''
        },
        setStudies(state, studies){
            state.studies = studies
        },
        clearStudies(state) {
            state.studies = ''
        },
        setHigherStudies(state, higherStudies){
            state.higherStudies = higherStudies
        },
        clearHigherStudies(state) {
            state.higherStudies = ''
        },
        setMasterCredentials(state, masterCredentials){
            state.masterCredentials = masterCredentials
        },
        clearMasterCredentials(state) {
            state.masterCredentials = ''
        },
    },
});
export default store;