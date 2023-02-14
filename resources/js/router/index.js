import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

/* Germany */

// Auth Components
import Login from "../components/de/auth/Login";
import Register from "../components/de/auth/Register";

// Dashboard Components
import Dashboard from "../components/de/profile/Dashboard";
import Profile from "../components/de/profile/Profile";
import Resume from "../components/de/profile/Resume";
import Portfolio from "../components/de/profile/Portfolio";
import AddWork from "../components/de/profile/AddWork";
import Jobs from "../components/de/profile/jobs/company/Jobs";
import AddJob from "../components/de/profile/jobs/company/AddJob";
import EditJob from "../components/de/profile/jobs/company/EditJob";
import AppliedJobs from "../components/de/profile/jobs/candidate/AppliedJobs";
import Applicants from "../components/de/profile/jobs/company/Applicants";
import MyAccount from "../components/de/profile/MyAccount";
import Shortlists from "../components/de/profile/Shortlists";
// Front Components
import UserProfileFront from "../components/de/front/Profile";
import JobFront from "../components/de/front/Job";
import JobsFront from "../components/de/front/Jobs";
import Resumes from "../components/de/front/Resumes";
import Business from "../components/de/front/Business";
import Home from "../components/de/front/Home";
import Page from "../components/de/front/Page"
// Global Components
import NotFound from "../components/de/global/NotFound";

/* English */

// Auth Components
import LoginEn from "../components/en/auth/Login";
import RegisterEn from "../components/en/auth/Register";

// Dashboard Components
import DashboardEn from "../components/en/profile/Dashboard";
import ProfileEn from "../components/en/profile/Profile";
import ResumeEn from "../components/en/profile/Resume";
import PortfolioEn from "../components/en/profile/Portfolio";
import AddWorkEn from "../components/en/profile/AddWork";
import JobsEn from "../components/en/profile/jobs/company/Jobs";
import AddJobEn from "../components/en/profile/jobs/company/AddJob";
import EditJobEn from "../components/en/profile/jobs/company/EditJob";
import AppliedJobsEn from "../components/en/profile/jobs/candidate/AppliedJobs";
import ApplicantsEn from "../components/en/profile/jobs/company/Applicants";
import MyAccountEn from "../components/en/profile/MyAccount";
import ShortlistsEn from "../components/en/profile/Shortlists";
// Front Components
import UserProfileFrontEn from "../components/en/front/Profile";
import JobFrontEn from "../components/en/front/Job";
import JobsFrontEn from "../components/en/front/Jobs";
import ResumesEn from "../components/en/front/Resumes";
import BusinessEn from "../components/en/front/Business";
import HomeEn from "../components/en/front/Home";
import PageEn from "../components/en/front/Page"

/* Arabic */

// Auth Components
import LoginAr from "../components/ar/auth/Login";
import RegisterAr from "../components/ar/auth/Register";

// Dashboard Components
import DashboardAr from "../components/ar/profile/Dashboard";
import ProfileAr from "../components/ar/profile/Profile";
import ResumeAr from "../components/ar/profile/Resume";
import PortfolioAr from "../components/ar/profile/Portfolio";
import AddWorkAr from "../components/ar/profile/AddWork";
import JobsAr from "../components/ar/profile/jobs/company/Jobs";
import AddJobAr from "../components/ar/profile/jobs/company/AddJob";
import EditJobAr from "../components/ar/profile/jobs/company/EditJob";
import AppliedJobsAr from "../components/ar/profile/jobs/candidate/AppliedJobs";
import ApplicantsAr from "../components/ar/profile/jobs/company/Applicants";
import MyAccountAr from "../components/ar/profile/MyAccount";
import ShortlistsAr from "../components/ar/profile/Shortlists";
// Front Components
import UserProfileFrontAr from "../components/ar/front/Profile";
import JobFrontAr from "../components/ar/front/Job";
import JobsFrontAr from "../components/ar/front/Jobs";
import ResumesAr from "../components/ar/front/Resumes";
import BusinessAr from "../components/ar/front/Business";
import HomeAr from "../components/ar/front/Home";
import PageAr from "../components/ar/front/Page"

const routes = new VueRouter({
    mode: 'history',
    routes: [
        // Germany
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
            path: '/page/:slug',
            component: Page,
            name: 'page'
        },
        // English
        {
            path: '/en',
            component: HomeEn,
            name: 'home-en'
        },
        {
            path: '/en/login',
            component: LoginEn,
            name: 'login-en'
        },
        {
            path: '/en/register',
            component: RegisterEn,
            name: 'register-en'
        },
        {
            path: '/en/dashboard',
            component: DashboardEn,
            name: 'dashboard-en'
        },
        {
            path: '/en/profile',
            component: ProfileEn,
            name: 'profile-en'
        },
        {
            path: '/en/profile/resume',
            component: ResumeEn,
            name: 'resume-en'
        },
        {
            path: '/en/profile/portfolio',
            component: PortfolioEn,
            name: 'portfolio-en'
        },
        {
            path: '/en/profile/portfolio/add',
            component: AddWorkEn,
            name: 'addWork-en'
        },
        {
            path: '/en/profile/jobs',
            component: JobsEn,
            name: 'jobs-en'
        },
        {
            path: '/en/profile/jobs/add',
            component: AddJobEn,
            name: 'addJob-en'
        },
        {
            path: '/en/u/:username',
            component: UserProfileFrontEn,
            name: 'userProfileFront-en'
        },
        {
            path: '/en/job/:id',
            component: JobFrontEn,
            name: 'jobFront-en'
        },
        {
            path: '/en/profile/applied-jobs',
            component: AppliedJobsEn,
            name: 'appliedJobs-en'
        },
        {
            path: '/en/profile/job/:id',
            component: ApplicantsEn,
            name: 'applicants-en'
        },
        {
            path: '/en/profile/job/edit/:id',
            component: EditJobEn,
            name: 'editJob-en'
        },
        {
            path: '/en/profile/my-account',
            component: MyAccountEn,
            name: 'myAccount-en'
        },
        {
            path: '/en/jobs',
            component: JobsFrontEn,
            name: 'jobsFront-en'
        },
        {
            path: '/en/resumes',
            component: ResumesEn,
            name: 'resumes-en'
        },
        {
            path: '/en/local-businesses',
            component: BusinessEn,
            name: 'business-en'
        },
        {
            path: '/en/profile/shortlists',
            component: ShortlistsEn,
            name: 'shortlists-en'
        },
        {
          path: '/en/page/:slug',
          component: PageEn,
          name: 'page-en'
        },
        // Arabic
        {
            path: '/ar',
            component: HomeAr,
            name: 'home-ar'
        },
        {
            path: '/ar/login',
            component: LoginAr,
            name: 'login-ar'
        },
        {
            path: '/ar/register',
            component: RegisterAr,
            name: 'register-ar'
        },
        {
            path: '/ar/dashboard',
            component: DashboardAr,
            name: 'dashboard-ar'
        },
        {
            path: '/ar/profile',
            component: ProfileAr,
            name: 'profile-ar'
        },
        {
            path: '/ar/profile/resume',
            component: ResumeAr,
            name: 'resume-ar'
        },
        {
            path: '/ar/profile/portfolio',
            component: PortfolioAr,
            name: 'portfolio-ar'
        },
        {
            path: '/ar/profile/portfolio/add',
            component: AddWorkAr,
            name: 'addWork-ar'
        },
        {
            path: '/ar/profile/jobs',
            component: JobsAr,
            name: 'jobs-ar'
        },
        {
            path: '/ar/profile/jobs/add',
            component: AddJobAr,
            name: 'addJob-ar'
        },
        {
            path: '/ar/u/:username',
            component: UserProfileFrontAr,
            name: 'userProfileFront-ar'
        },
        {
            path: '/ar/job/:id',
            component: JobFrontAr,
            name: 'jobFront-ar'
        },
        {
            path: '/ar/profile/applied-jobs',
            component: AppliedJobsAr,
            name: 'appliedJobs-ar'
        },
        {
            path: '/ar/profile/job/:id',
            component: ApplicantsAr,
            name: 'applicants-ar'
        },
        {
            path: '/ar/profile/job/edit/:id',
            component: EditJobAr,
            name: 'editJob-ar'
        },
        {
            path: '/ar/profile/my-account',
            component: MyAccountAr,
            name: 'myAccount-ar'
        },
        {
            path: '/ar/jobs',
            component: JobsFrontAr,
            name: 'jobsFront-ar'
        },
        {
            path: '/ar/resumes',
            component: ResumesAr,
            name: 'resumes-ar'
        },
        {
            path: '/ar/local-businesses',
            component: BusinessAr,
            name: 'business-ar'
        },
        {
            path: '/ar/profile/shortlists',
            component: ShortlistsAr,
            name: 'shortlists-ar'
        },
        {
            path: '/ar/page/:slug',
            component: PageAr,
            name: 'page-ar'
        },
        {
            path: '*',
            component: NotFound,
            name: 'not_found'
        }
    ]
});

export default routes;
