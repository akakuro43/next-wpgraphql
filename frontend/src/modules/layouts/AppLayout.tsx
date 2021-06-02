import { useRef, useEffect } from 'react'
import { useSetRecoilState } from 'recoil'
import { useRouter } from 'next/router'
// import { navOpenState } from '~/stores/navOpen'
import { AnimatePresence } from 'framer-motion'
import Header from './Header'
// import RightBar from './RightBar'
// import style from '~/style/layout/_AppLayout.module.sass'

type ContainerProps = {
  className?: string
}

type Props = {} & ContainerProps

const AppLayout: React.FC<Props> = (props) => {
  const router = useRouter()
  // const setNavStatus = useSetRecoilState(navOpenState)
  const refContainer = useRef<HTMLDivElement>(null)

  const transitionCallback = (): void => {
    if (refContainer.current === null) return
    refContainer.current.scrollTop = 0
  }

  // useEffect(() => {
  //   setNavStatus(false)
  // }, [router.pathname])

  return (
    <div className={` relative z-[1] sm:min-w-[421px] sm:w-[34%] max-w-[600px] w-full h-full bg-black sm:pl-24px`}>
      <main className={` main-container w-full h-full relative pt-[22px]`}>
        <Header />
        <div className={``} ref={refContainer}>
          <AnimatePresence exitBeforeEnter onExitComplete={transitionCallback} initial={false}>
            {props.children}
          </AnimatePresence>
        </div>
      </main>
    </div>
  )
}

export default AppLayout
