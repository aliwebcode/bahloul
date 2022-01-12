import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

// Auth Components
import Login from "../components/auth/Login";
import Register from "../components/auth/Register";

// Dashboard Components
import Dashboard from "../components/profile/Dashboard";
import Profile from "../components/profile/Profile";
import Resume from "../components/profile/Resume";
import Portfolio from "../components/profile/Portfolio";
import AddWork from "../components/profile/AddWork";
import Jobs from "../components/profile/jobs/company/Jobs";
import AddJob from "../components/profile/jobs/company/AddJob";
import EditJob from "../components/profile/jobs/company/EditJob";
import AppliedJobs from "../components/profile/jobs/candidate/AppliedJobs";
import Applicants from "../components/profile/jobs/company/Applicants";
import MyAccount from "../components/profile/MyAccount";
import Shortlists from "../components/profile/Shortlists";
// Front Components
import UserProfileFront from "../components/front/Profile";
import JobFront from "../components/front/Job";
import JobsFront from "../components/front/Jobs";
import Resumes from "../components/front/Resumes";
import Business from "../components/front/Business";
import Home from "../components/front/Home";
// Global Components
import NotFound from "../components/global/NotFound";

const routes = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Home,
            name: 'home'
        },
        {
            path: '/login',
            component: Login,
            name: 'login'
        },
        {
            path: '/register',
            component: Register,
            name: 'register'
        },
        {
            path: '/dashboard',
            component: Dashboard,
            name: 'dashboard'
        },
        {
            path: '/profile',
            component: Profile,
            name: 'profile'
        },
        {
            path: '/profile/resume',
            component: Resume,
            name: 'resume'
        },
        {
            path: '/profile/portfolio',
            component: Portfolio,
            name: 'portfolio'
        },
        {
            path: '/profile/portfolio/add',
            component: AddWork,
            name: 'addWork'
        },
        {
            path: '/profile/jobs',
            component: Jobs,
            name: 'jobs'
            // meta: {title: 'My Jobs'}
        },
        {
            path: '/profile/jobs/add',
            component: AddJob,
            name: 'addJob'
        },
        {
            path: '/u/:username',
            component: UserProfileFront,
            name: 'userProfileFront'
        },
        {
            path: '/job/:id',
            component: JobFront,
            name: 'jobFront'
        },
        {
            path: '/profile/applied-jobs',
            component: AppliedJobs,
            name: 'appliedJobs'
        },
        {
            path: '/profile/job/:id',
            component: Applicants,
            name: 'applicants'
        },
        {
            path: '/profile/job/edit/:id',
            component: EditJob,
            name: 'editJob'
        },
        {
            path: '/profile/my-account',
            component: MyAccount,
            name: 'myAccount'
        },
        {
            path: '/jobs',
            component: JobsFront,
            name: 'jobsFront'
        },
        {
            path: '/resumes',
            component: Resumes,
            name: 'resumes'
        },
        {
            path: '/local-businesses',
            component: Business,
            name: 'business'
        },
        {
            path: '/profile/shortlists',
            component: Shortlists,
            name: 'shortlists'
        },
        {
            path: '*',
            component: NotFound,
            name: 'not_found'
        }
    ]
});

// routes.beforeEach((to, from, next) => {
//     if(to.path != '/login' && to.meta.requiresAuth && !store.state.auth.status.loggedIn){
//         next('/login');
//     } else if (from.path == '/login' && to.meta.requiresAuth && store.state.auth.status.loggedIn){
//         console.log('this hit')
//         next();
//     } else {
//         next();
//     }
// })


// routes.beforeEach((to, from, next) => {
//     document.title = to.meta.title
//     next()
// });
export default routes;
