//auth
import Login from './app/pages/Login'
//admin
import Dashbord from './app/pages/Dashbord'
import Master from './app/pages/Master'
import User from './app/pages/User'
import Diploma from './app/pages/Diploma'
import Establishment from './app/pages/Establishment'
import Speciality from './app/pages/Speciality'
import Subject from './app/pages/Subject'
import Profile from './app/pages/Profile'

//client
import Home from './app/pages/client/Home'
import MasterCandidacy from './app/pages/client/MasterCandidacy'
import NewMasterCandidacy from './app/pages/client/NewMasterCandidacy'
import MasterCandidacyConnexion from './app/pages/client/MasterCandidacyConnexion'
import ModifyMasterCandidacy from './app/pages/components/client/studie/MasterCandidacy/ModifyMasterCandidacy'
import PrintMasterCandidacy from './app/pages/components/client/studie/MasterCandidacy/PrintMasterCandidacy'
import News from './app/pages/client/News'
import About from './app/pages/client/About'
import Contact from './app/pages/client/Contact'


import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    //auth
    {
        path: "/login",
        name: "Login",
        component: Login
    },
    //admin
    {
        path: "/admin",
        name: "Dashbord",
        component: Dashbord
    },
    {
        path: "/admin/masters",
        name: "Masters",
        component: Master
    },
    {
        path: "/admin/diplomas",
        name: "Diplomas",
        component: Diploma
    },
    {
        path: "/admin/admins",
        name: "Admins",
        component: User
    },
    {
        path: "/admin/establishments",
        name: "Establishments",
        component: Establishment
    },
    {
        path: "/admin/specialities",
        name: "Specialities",
        component: Speciality
    },
    {
        path: "/admin/subjects",
        name: "Subjects",
        component: Subject
    },
    {
        path: "/admin/profile",
        name: "Profile",
        component: Profile
    },

    //client
    {
        path: "/",
        name: "Home",
        component: Home
    },
    {
        path: "/studies/master/candidacy",
        name: "MasterCandidacy",
        component: MasterCandidacy,
        children: 
        [
            {
                path: "new",
                name: "NewMasterCandidacy",
                component: NewMasterCandidacy,
            },
            {
                path: ':id',
                name: 'MasterCandidacyConnexion',
                component: MasterCandidacyConnexion,
                children: 
                [
                    {
                        path: "modify",
                        name: "ModifyMasterCandidacy",
                        component: ModifyMasterCandidacy,
                    },
                    {
                        path: 'print',
                        name: 'PrintMasterCandidacy',
                        component: PrintMasterCandidacy
                    }
                ]
            }
        ]
    },
    {
        path: "/news",
        name: "News",
        component: News
    },
    {
        path: "/about",
        name: "About",
        component: About
    },
    {
        path: "/contact",
        name: "Contact",
        component: Contact
    },
];

const router = createRouter({
    history: createWebHistory(process.env.APP_URL),
    routes,
});
export default router