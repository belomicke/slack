import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import { AuthPage, LoginPage, SignupPage, WelcomePage } from '@/pages'

const routes: RouteRecordRaw[] = [
    {
        path: '/',
        component: WelcomePage
    },
    {
        path: '/auth',
        component: AuthPage,
        children: [
            {
                path: 'login',
                component: LoginPage
            },
            {
                path: 'signup',
                component: SignupPage
            }
        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach(async (to, from, next) => {
    const isAuth = localStorage.getItem('token')
    const authPaths = ['/auth/login', '/auth/signup']

    if (authPaths.includes(to.path) && isAuth) {
        return next({
            path: '/'
        })
    } else if (!authPaths.includes(to.path) && !isAuth) {
        return next({
            path: '/auth/login'
        })
    } else {
        return next()
    }
})

export default router
