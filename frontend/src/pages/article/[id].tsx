import s from '~/style/component/ArticleSingle.module.sass'
import Head from 'next/head'
// import Header from '../../modules/layouts/Header'
// import Footer from '../../modules/layouts/Footer'
import TransitionWrapper from '~/modules/layouts/TransitionWrapper.tsx'

export default function ArtivleId({ article }) {
  const formatDate = (dateStr) => {
    return dateStr.substr(0, 10).split('-').join('.')
  }
  return (
    <TransitionWrapper
      pageName='detail'
      wrapperVariants={{
        initial: { y: '-25px', opacity: 0 },
        enter: { y: '0', opacity: 1, transition: { duration: 0.7, ease: [0.19, 0.82, 0.27, 1], delay: 0.1 } },
        exit: { y: '10px', opacity: 0, transition: { duration: 0.2 } },
      }}>
      <Head>
         <title>Create Next App</title>
         <link rel="icon" href="/favicon.ico" />
      </Head>
      <section className={`${s.pArticle} pt-144px pb-80px`}>
        <div className="pj-innerSlim">
          <div className={`${s.articleHeader} relative`}>
            <ul className={`flex`}>
              <li className={`mr-16px`}>
                <p className={`text-13px font-bold text-key-color`}>エンジニアリング</p>
              </li>
              <li className={`mr-16px`}>
                <p className={`text-13px font-bold text-key-color`}>開発</p>
              </li>
            </ul>
            <h1 className={`text-48px leading-125 mt-24px mb-20px font-bold tracking-wide text-off-white`}>{article.title}</h1>
            <p className={`text-18px leading-175 mb-32px font-medium tracking-wide text-gray`}>{article.description}</p>
            <div className={`flex mt-20px`}>
                      <p className={`text-14px font-regular flex items-center text-gray`}>
                      <svg className={`mr-4px`} width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.0009 0C7.19184 0.055625 1.50777 0.596875 1.11043 4.49391C1.06215 4.91047 1.0348 5.32891 1.01684 5.74766L3.81168 2.95562C3.90934 2.85797 4.06793 2.85797 4.16559 2.95562C4.26324 3.05328 4.26324 3.21156 4.16559 3.30922L0.110898 7.35984C-0.0356641 7.50625 -0.0356641 7.74375 0.110898 7.89016C0.257461 8.03656 0.495117 8.03656 0.641836 7.89016L1.53449 6.99844C2.19215 6.99625 2.84934 6.95891 3.50262 6.88344C4.33824 6.79844 5.01855 6.46984 5.57418 6H3.99684L6.29043 5.23625C6.46621 5.00359 6.62434 4.75641 6.76621 4.5H5.4984L7.16309 3.66859C7.81793 2.07594 7.97262 0.410312 8.0009 0Z" fill="#ADADAB"/>
                      </svg>
                      {formatDate(article.createdAt)}</p>
                      <p className={`text-14px font-regular flex items-center text-gray ml-12px`}>
                      <svg className={`mr-4px`} width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.99289 0.125006C2.95744 0.126866 2.0173 0.534897 1.3232 1.19821L0.765172 0.640178C0.528922 0.403928 0.125 0.571241 0.125 0.905334V3C0.125 3.20711 0.292891 3.375 0.5 3.375H2.59467C2.92877 3.375 3.09608 2.97108 2.85984 2.73483L2.2075 2.08249C2.68975 1.63094 3.31377 1.38082 3.97672 1.3751C5.42044 1.36263 6.63739 2.53099 6.62491 4.02263C6.61306 5.43764 5.46588 6.625 4 6.625C3.35739 6.625 2.75005 6.39566 2.27141 5.97569C2.1973 5.91068 2.08537 5.91463 2.01566 5.98433L1.39594 6.60405C1.31981 6.68017 1.32358 6.80428 1.40347 6.87644C2.09059 7.49708 3.00116 7.875 4 7.875C6.14009 7.875 7.87498 6.14011 7.875 4.00004C7.87502 1.8624 6.13053 0.121178 3.99289 0.125006Z" fill="#ADADAB"/>
                        </svg>
                        {formatDate(article.updatedAt)}</p>
            </div>
            <div className={`w-full mt-56px mb-80px`}>
              <img className={`rounded-4px`} src={article.thumb.url}></img>
            </div>
          </div>
          <div className={s.articleBody}  
            dangerouslySetInnerHTML={{
              __html: `${article.body}`,
            }}
          />
          <div className={`${s.articleFooter} mt-56px`}>
            <div className={`w-full h-80px relative z-20 rounded-6px bg-dark3`}>
            </div>
          </div>
        </div>
      </section>
    </TransitionWrapper>
  );
}

// 静的生成のためのパスを指定します
export const getStaticPaths = async () => {
  const key: Object = {
    headers: {'X-API-KEY': process.env.API_KEY},
  };
  const data = await fetch('https://curiosology.microcms.io/api/v1/blog', key)
    .then(res => res.json())
    .catch(() => null);
  const paths = data.contents.map(content => `/article/${content.id}`);
  return {paths, fallback: false};
};

// データをテンプレートに受け渡す部分の処理を記述します
export const getStaticProps = async context => {
  const id = context.params.id;
  const key: Object = {
    headers: {'X-API-KEY': process.env.API_KEY},
  };
  const data = await fetch(
    'https://curiosology.microcms.io/api/v1/blog/' + id,
    key,
  )
    .then(res => res.json())
    .catch(() => null);
  return {
    props: {
      article: data,
      revalidate: 300,
    },
  };
};