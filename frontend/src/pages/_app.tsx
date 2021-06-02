import '~/style/globals.sass'
import Image from 'next/image'
import { RecoilRoot } from 'recoil'
import { AppProps } from 'next/app'
import AppLayout from '../modules/layouts/AppLayout'

function MyApp({ Component, pageProps, router }: AppProps) {
  return (
    <>
      <div className='base'>
        <RecoilRoot>
          <AppLayout>
            <Component {...pageProps} key={router.route} />
          </AppLayout>
        </RecoilRoot>
      </div>
    </>
  )
}

export default MyApp
