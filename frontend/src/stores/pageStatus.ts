import { atom } from 'recoil'
import { PageType, PageStatus } from '~/models/page'

export const currentPage = atom<PageType>({
  key: 'currentPage',
  default: 'loading',
})

export const pageStatus = atom<PageStatus>({
  key: 'pageStatus',
  default: 'active',
})
