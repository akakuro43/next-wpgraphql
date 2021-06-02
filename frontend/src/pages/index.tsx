import React from 'react'
// import { NextPage } from 'next'
import { getPaginatedPosts } from '~/apollo/lib/posts'
import s from '~/style/component/Home.module.sass'
import { Head } from '../modules/utils/Head'
import Link from 'next/link'
import TransitionWrapper from '~/modules/layouts/TransitionWrapper'

// import Header from '../modules/layouts/Header'
// import Footer from '../modules/layouts/Footer'

export default function Home({ posts }) {

  // const formatDate = (dateStr) => {
  //   return dateStr.substr(0, 10).split('-').join('.')
  // }

  return (
    <TransitionWrapper
      pageName='top'
      wrapperVariants={{
        initial: { y: '-25px', opacity: 0 },
        enter: { y: '0', opacity: 1, transition: { duration: 0.7, ease: [0.19, 0.82, 0.27, 1], delay: 0.1 } },
        exit: { y: '10px', opacity: 0, transition: { duration: 0.2 } },
      }}>
      <Head></Head>
      <ul>
        {posts.map((post) => {
          return (
            <li>
              <h2 className={`text-off-white`}>{`${post.title}`}</h2>
            </li>
          );
        })}
      </ul>
    </TransitionWrapper>
  );
}


// データをテンプレートに受け渡す部分の処理を記述します
// export const getStaticProps = async () => {

//   const key: Object = {
//     headers: {'X-API-KEY': process.env.API_KEY},
//   };

//   const data = await fetch('https://curiosology.microcms.io/api/v1/blog', key)
//     .then(res => 
//       res.json()
//     )
//     .catch(() => null);
//   return {
//     props: {
//       article: data.contents,
//       revalidate: 300,
//     },
//   };
// };

export async function getStaticProps() {
  const { posts, pagination } = await getPaginatedPosts();
  console.log(posts)
  return {
    props: {
      posts,
      pagination: {
        ...pagination,
        basePath: '/posts',
      },
    },
  };
}