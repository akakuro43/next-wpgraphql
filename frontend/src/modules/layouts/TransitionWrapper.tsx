import { useEffect } from 'react'
import { useRecoilState } from 'recoil'
import { currentPage } from '~/stores/pageStatus'
import { motion } from 'framer-motion'
// import Footer from '~/modules/layouts/Footer'
import { PageType } from '~/models/page'
// import * as Scroll from 'react-scroll'

type ContainerProps = {
  pageName: PageType
  wrapperVariants: any
}

type Props = {} & ContainerProps

const TransitionWrapper: React.FC<Props> = (props) => {
  const [page, setCurrentPage] = useRecoilState(currentPage)

  useEffect(() => {
    setCurrentPage(props.pageName)

    // if (props.pageName === 'top' && window.location.hash === '#concept') {
    //   Scroll.scroller.scrollTo('concept', {
    //     duration: 0,
    //     delay: 0,
    //     offset: -30,
    //     smooth: 'easeInOutCubic',
    //     containerId: 'scrollArea',
    //   })
    // }

    Array.from(document.querySelectorAll('head > link[rel="stylesheet"][data-n-p]')).forEach((node) => {
      node.removeAttribute('data-n-p')
    })
    const mutationHandler = (mutations) => {
      mutations.forEach(({ target }) => {
        if (target.nodeName === 'STYLE') {
          if (target.getAttribute('media') === 'x') {
            target.removeAttribute('media')
          }
        }
      })
    }
    const observer = new MutationObserver(mutationHandler)
    observer.observe(document.head, {
      subtree: true,
      attributeFilter: ['media'],
    })
    return () => {
      observer.disconnect()
    }
  }, [])

  return (
    <motion.div className={`relative`} initial='initial' animate='enter' exit='exit' variants={props.wrapperVariants}>
      {props.children}
    </motion.div>
  )
}

export default TransitionWrapper
