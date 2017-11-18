import Vue from 'vue'
import Router from 'vue-router'
import WarblerFeed from '@/components/WarblerFeed'
import WarblerProfile from '@/components/WarblerProfile'
import WarblerLogin from '@/components/WarblerLogin'
import WarblerCreateAccount from '@/components/WarblerCreateAccount'
import WarblerCompose from '@/components/WarblerCompose'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Warbler Feed',
      component: WarblerFeed
    },
    {
      path: '/profile',
      name: 'Warbler Profile',
      component: WarblerProfile
    },
    {
      path: '/login',
      name: 'Warbler Login',
      component: WarblerLogin
    },
    {
      path: '/account/create',
      name: 'Warbler Create Account',
      component: WarblerCreateAccount
    },
    {
      path: '/warble',
      name: 'Warbler Compose',
      component: WarblerCompose
    }
  ]
})
