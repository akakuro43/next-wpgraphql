import Link from 'next/link'
// import s from '~/style/layouts/Header.module.sass'
import { useRecoilState, useRecoilValue } from 'recoil'
import { currentPage } from '~/stores/pageStatus'

const navItems = [
  {name: 'HOME', url: '/'},
  {name: 'ARTICLE', url: '/article'},
  {name: 'README', url: '/readme'},
];
const stateCurrent = '/'

type ContainerProps = {
  className?: string
}

type Props = {} & ContainerProps

const Header: React.VFC<Props> = () => {
  const pageName = useRecoilValue(currentPage)
  
  return (
  <header className={`h-64px fixed z-50 w-full flex items-center`}>
    <div className={`opacity-0 bg-dark1 inset-0 absolute`}></div>
    <div className="pj-inner">
      <ul className="flex">
      {navItems.map(nav => (
        <li key={nav.name} className={`opacity-40 mr-20px ${stateCurrent == nav.url ? 'opacity-100' : ''}`}>
          <Link href={`${nav.url}`}>
            <a className={`text-13px py-10px font-bold text-light-gray`}>{nav.name}</a>
          </Link>
        </li>
      ))}
      </ul>
      <p className={`${pageName}`}>{`${pageName}hogehgoe`}</p>
    </div>
  </header>
  )
}

export default Header