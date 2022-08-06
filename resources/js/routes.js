import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store';
Vue.use(VueRouter);

/* -------------------------------------  Simple User   ------------------------------------- */
import Home from './components/UserSide/Pages/Home.vue';

/* Network */
import FicheEnsa from './components/UserSide/Pages/FicheENSA.vue';

/* ENSA Familly */
import Events from './components/UserSide/Pages/Events.vue';
import News from './components/UserSide/Pages/News.vue';
import Clubs from './components/UserSide/Pages/Clubs.vue';
import SingleNews from './components/UserSide/Pages/SingleNews.vue';
import SingleEvents from './components/UserSide/Pages/SingleEvents.vue';
import SingleClubs from './components/UserSide/Pages/SingleClubs.vue';

/* Professional */
import Jobs from './components/UserSide/Pages/Jobs.vue';
import Internships from './components/UserSide/Pages/Internships.vue';

/* ENSA Docs */
import Courses from './components/UserSide/Pages/Courses.vue';
import SingleModule from './components/UserSide/Pages/SingleModule.vue';
import Orientations  from './components/UserSide/Pages/Orientations.vue';

/* About Us */
import AboutUS from './components/UserSide/Pages/AboutUS.vue';
import Gallery from './components/UserSide/Pages/Gallery.vue';
import FAQ from './components/UserSide/Pages/FAQ.vue';
import PrivacyPolicy from './components/UserSide/Pages/PrivacyPolicy.vue';
import TermsConditions from './components/UserSide/Pages/TermsConditions.vue';

/* Contact */
import Contact from './components/UserSide/Pages/Contact.vue';

/* -------------------------------------  Super User   ------------------------------------- */
import Login from './components/AdminSide/Pages/Signin.vue';
import Admin from './components/AdminSide/Pages/Admin.vue';
import Moderator from './components/AdminSide/Pages/Moderator.vue';
import EnsasList from './components/AdminSide/Components/EnsasList.vue';
import EventsList from './components/AdminSide/Components/EventsList.vue';
import ClubsList from './components/AdminSide/Components/ClubsList.vue'
import NewsList from './components/AdminSide/Components/NewsList.vue';
import Profile from './components/AdminSide/Components/Profile.vue';
import Dashboard from './components/AdminSide/Components/Dashboard.vue';
import UsersList from './components/AdminSide/Components/UsersList.vue';
import WebsiteSettings from './components/AdminSide/Components/WebsiteSettings.vue';
import FAQList from './components/AdminSide/Components/FAQList.vue';
import OpportunitiesList from './components/AdminSide/Components/OpportunitiesList.vue';
import CoursesList from './components/AdminSide/Components/CoursesList.vue';
import OrientationsList from './components/AdminSide/Components/OrientationsList.vue';
import MessagesList from './components/AdminSide/Components/MessagesList.vue';
import MyENSA from './components/AdminSide/Components/MyENSA.vue';

/* -------------------------------------  Error pages  ------------------------------------- */
import Error403 from './components/ErrorPages/403.vue';
import Error404 from './components/ErrorPages/404.vue';
import Error500 from './components/ErrorPages/500.vue';
import Error503 from './components/ErrorPages/503.vue';

export const routes = [
  {
    name: "error403",
    path: '/403',
    component: Error403,
    meta: {
      middleware: "guest",
      title: `Forbidden error`
    }
  },
  {
    name: "error500",
    path: '/500',
    component: Error500,
    meta: {
      middleware: "guest",
      title: `Internal server error`
    }
  },
  {
    name: "error503",
    path: '/503',
    component: Error503,
    meta: {
      middleware: "guest",
      title: `Service not available`
    }
  },
  {
    name: "error404",
    path: '/404',
    component: Error404,
    meta: {
      middleware: "guest",
      title: `Page not found`
    }
  },
  // {
  //   name: "error404",
  //   path: '*',
  //   redirect: '/404',
  //   meta: {
  //     middleware: "guest",
  //     title: `Page not found`
  //   }
  // },
  {
    path: "/admin",
    component: Admin,
    meta: {
      middleware: "auth",
    },
    children: [
      {
        name: "adminEnsas",
        path: 'ensas',
        component: EnsasList,
        meta: {
          title: `List of ENSAs`,
        }
      },
      {
        name: "adminUsers",
        path: 'users',
        component: UsersList,
        meta: {
          title: `Users list`,
        }
      },
      {
        name: "adminDashboard",
        path: 'dashboard',
        component: Dashboard,
        meta: {
          title: `Dashboard`,
        }
      },
      {
        name: "adminEvents",
        path: 'events',
        component: EventsList,
        meta: {
          title: `Events list`,
        }
      },
      {
        name: "adminClubs",
        path: 'clubs',
        component: ClubsList,
        meta: {
          title: `Clubs list`,
        }
      },
      {
        name: "adminNews",
        path: 'news',
        component: NewsList,
        meta: {
          title: `News list`,
        }
      },
      {
        name: "adminopportunities",
        path: 'opportunities',
        component: OpportunitiesList,
        meta: {
          title: `Opportunities list`,
        }
      },
      {
        name: "websiteSettings",
        path: 'websitesettings',
        component: WebsiteSettings,
        meta: {
          title: `Website settings`,
        }
      },
      {
        name: "adminCourses",
        path: 'coursesdocs',
        component: CoursesList,
        meta: {
          title: `Courses list`,
        }
      },
      {
        name: "adminOrientations",
        path: 'orientationdocs',
        component: OrientationsList,
        meta: {
          title: `Orientations list`,
        }
      },
      {
        name: "adminfaq",
        path: 'faqs',
        component: FAQList,
        meta: {
          title: `FAQ list`,
        }
      },
      {
        name: "adminmessages",
        path: 'contactmessages',
        component: MessagesList,
        meta: {
          title: `Messages list`,
        }
      },
      {
        name: "profile",
        path: 'profile',
        component: Profile,
        meta: {
          title: `My profile`,
        }
      }
    ]
  },
  {
    path: "/moderator",
    component: Moderator,
    meta: {
      middleware: "auth"
    },
    children: [
      {
        name: "Events",
        path: 'events',
        component: EventsList,
        meta: {
          title: `Events list`
        }
      },
      {
        name: "moderatorENSA",
        path: 'myensa',
        component: MyENSA,
        meta: {
          title: `My ENSA`,
        }
      },
      {
        name: "moderatorProfile",
        path: 'profile',
        component: Profile,
        meta: {
          title: `My profile`,
        }
      }
    ]
  },
  {
    name: 'login',
    path: '/login',
    component: Login,
    meta: {
      middleware: "guest",
      title: `Sign In`
    }
  },
  {
    name: 'home',
    path: '/',
    component: Home,
    meta: {
      middleware: "guest",
      title: `Home`
    }
  },
  {
    name: 'ficheEnsa',
    path: '/ensa/:id',
    component: FicheEnsa,
    meta: {
      middleware: "guest",
      title: `ENSA`
    }
  },
  {
    name: 'news',
    path: '/news',
    component: News,
    meta: {
      middleware: "guest",
      title: `News`
    }
  },
  {
    name: 'events',
    path: '/events',
    component: Events,
    meta: {
      middleware: "guest",
      title: `Events`
    }
  },
  {
    name: 'clubs',
    path: '/clubs',
    component: Clubs,
    meta: {
      middleware: "guest",
      title: `Clubs`
    }
  },
  {
    name: 'single news',
    path: '/singleNews/:id',
    component: SingleNews,
    meta: {
      middleware: "guest",
      title: `News`
    }
  },
  {
    name: 'single event',
    path: '/singleEvent/:id',
    component: SingleEvents,
    meta: {
      middleware: "guest",
      title: `Events`
    }
  },
  {
    name: 'single club',
    path: '/singleClub/:id',
    component: SingleClubs,
    meta: {
      middleware: "guest",
      title: `Clubs`
    }
  },
  {
    name: 'jobs',
    path: '/jobs',
    component: Jobs,
    meta: {
      middleware: "guest",
      title: `Jobs & Opportunities`
    }
  },
  {
    name: 'internships',
    path: '/internships',
    component: Internships,
    meta: {
      middleware: "guest",
      title: `Internships`
    }
  },
  {
    name: 'courses',
    path: '/courses',
    component: Courses,
    meta: {
      middleware: "guest",
      title: `Courses`
    }
  },
  {
    name: 'singleModule',
    path: '/singleModule/:id',
    component: SingleModule,
    meta: {
      middleware: "guest",
      title: `Module`
    }
  },
  {
    name: 'orientations',
    path: '/orientations',
    component: Orientations,
    meta: {
      middleware: "guest",
      title: `Orientations`
    }
  },
  {
    name: 'about',
    path: '/about',
    component: AboutUS,
    meta: {
      middleware: "guest",
      title: `About us`
    }
  },
  {
    name: 'gallery',
    path: '/gallery',
    component: Gallery,
    meta: {
      middleware: "guest",
      title: `Gallery`
    }
  },
  {
    name: 'faq',
    path: '/faq',
    component: FAQ,
    meta: {
      middleware: "guest",
      title: `FAQ`
    }
  },
  {
    name: 'privacypolicy',
    path: '/privacypolicy',
    component: PrivacyPolicy,
    meta: {
      middleware: "guest",
      title: `Privacy Policy`
    }
  },
  {
    name: 'termsconditions',
    path: '/termsconditions',
    component: TermsConditions,
    meta: {
      middleware: "guest",
      title: `Terms and conditions`
    }
  },
  {
    name: 'contact',
    path: '/contact',
    component: Contact,
    meta: {
      middleware: "guest",
      title: `Contact`
    }
  },
];