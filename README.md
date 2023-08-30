# SYZOJ-Kor
[HustOJ SYZOJ](https://github.com/zhblue/hustoj/tree/master/trunk/web/template/syzoj) 테마의 한국어 번역 버전입니다.

Korean version of the [HustOJ SYZOJ theme](https://github.com/zhblue/hustoj/tree/master/trunk/web/template/syzoj).

## Install
<pre><code>vim update.sh
</code></pre>
<pre><code>#!/bin/bash
#Update Script

if [[ -z $SUDO_USER ]] ; then
  echo "Use 'sudo bash ${THISFILE}'"
  exit 1
fi

cd /home/judge/src/web/ || exit

wget https://github.com/syudal/SYZOJ-Kor/archive/refs/heads/main.zip
unzip -o main.zip -d template
rm main.zip

cd template
rm -rf syzoj-kor

mkdir syzoj-kor
cp -r SYZOJ-Kor-main/* syzoj-kor/

chown -R www-data:www-data syzoj-kor
rm -rf SYZOJ-Kor-main
</code></pre>
<pre><code>sudo bash update.sh
</code></pre>
