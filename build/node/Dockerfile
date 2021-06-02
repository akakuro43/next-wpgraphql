# --------------------
#  node用のDockerfile
# --------------------

# node16.0.0を使用する
FROM node:16.0.0-alpine
# 仮想のワークDIRとして「app」を作成
WORKDIR /app
# 必要なファイルをコピー
# COPY package.json ./
COPY . .
# node packageをインストール
RUN yarn install
