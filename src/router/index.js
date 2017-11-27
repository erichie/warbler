import Vue from 'vue'
import Router from 'vue-router'
import WarblerFeed from '@/components/WarblerFeed'
import WarblerProfile from '@/components/WarblerProfile'
import WarblerLogin from '@/components/WarblerLogin'
import WarblerCreateAccount from '@/components/WarblerCreateAccount'
import WarblerCompose from '@/components/WarblerCompose'
import WarblerHashtagFeed from '@/components/WarblerHashtagFeed'
import WarblerEditProfile from '@/components/WarblerEditProfile'

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
      path: '/profile/edit',
      name: 'Warbler Edit Profile',
      component: WarblerEditProfile
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
    },
    {
      path: '/feed/hashtag',
      name: 'Warbler Hashtag Feed',
      component: WarblerHashtagFeed
    }
  ]
})
