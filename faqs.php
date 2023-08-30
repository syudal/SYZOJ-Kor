<?php $show_title = "$MSG_FAQ - $OJ_NAME"; ?>
<?php include("template/$OJ_TEMPLATE/header.php"); ?>
<div class="padding">
    <h1 class="ui center aligned header">자주 묻는 질문</h1>
    <div style="font-content">
        <h2 class="ui header">컴파일 옵션</h2>
        <p>Java와 Python3으로 제출한 경우 추가 시간이 제공됩니다.</p>
        <table id="result-tab" class="ui very basic center aligned table" style="white-space: nowrap; ">
            <thead>
                <tr>
                    <th style="width: 15%;">언어</th>
                    <th style="width: 15%;">컴파일러 버전</th>
                    <th style="width: 70%;">컴파일 옵션</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>C</th>
                    <th>gcc 9.4.0</th>
                    <th>gcc Main.c -o Main -fno-asm -Wall -lm --static -O2 -std=c99 -DONLINE_JUDGE</th>
                </tr>
                <tr>
                    <th>C++</th>
                    <th>g++ 9.4.0</th>
                    <th>g++ -fno-asm -Wall -lm --static -O2 -std=c++14 -DONLINE_JUDGE -o Main Main.cc</th>
                </tr>
                <tr>
                    <th>Java</th>
                    <th>OpenJDK 17.0.4</th>
                    <th>javac -J-Xms32m -J-Xmx256m Main.java</th>
                </tr>
                <tr>
                    <th>Python3</th>
                    <th>python 3.8.10</th>
                    <th>python3 -m py_compile Main.py</th>
                </tr>
            </tbody>
        </table>

        <h2 class="ui header">채점 결과</h2>
        <table id="result-tab" class="ui very basic center aligned table" style="white-space: nowrap; ">
            <thead>
                <tr>
                    <th style="width: 30%;">채점 결과</th>
                    <th style="width: 70%;">설명</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>채점 대기중</th>
                    <th>코드가 제출되고 채점을 기다리고 있는 상태입니다. 대부분의 경우 조금만 기다리면 채점이 진행됩니다.</th>
                </tr>
                <tr>
                    <th>재채점 대기중</th>
                    <th>채점 데이터가 갱신되어 재채점을 기다리고 있는 상태입니다.</th>
                </tr>
                <tr>
                    <th>컴파일중</th>
                    <th>제출된 코드를 컴파일하는 중입니다.</th>
                </tr>
                <tr>
                    <th>채점중</th>
                    <th>채점이 진행되고 있는 중입니다.</th>
                </tr>
                <tr>
                    <th>모두 맞음</th>
                    <th>모든 채점 데이터에 대해서 정확한 답을 출력했다는 의미입니다.</th>
                </tr>
                <tr>
                    <th>출력형식 다름</th>
                    <th>출력된 결과가 문제에서 출력해야하는 출력형식과 다르게 출력되었다는 의미입니다. 문제의 출력형식에서 요구하는 형식과 똑같아야 합니다. 답 출력 후 출력형식에는 없는 공백문자나
                        줄 바꿈이 더 출력되지는 않았는지 확인해 보아야 합니다.</th>
                </tr>
                <tr>
                    <th>틀림</th>
                    <th>틀린 답을 출력헸다는 의미입니다. 채점 시스템에 등록하는 채점 데이터들은 외부로 공개하지 않는 것이 일반적입니다. 제출한 코드가 틀린 답을 출력하는 경우가 어떤 경우일지 더
                        생각해 보아야 합니다.</th>
                </tr>
                <tr>
                    <th>시간제한 초과</th>
                    <th>제한시간 이내에 답을 출력하지 못했다는 의미입니다. 좀 더 빠르면서도 정확한 결과를 출력하도록 소스 코드를 수정해야합니다.</th>
                </tr>
                <tr>
                    <th>메모리제한 초과</th>
                    <th>제출한 프로그램이 제한된 메모리용량보다 더 많은 메모리을 사용했다는 의미입니다. 메모리를 더 적게 사용하는 코드로 수정해야합니다.</th>
                </tr>
                <tr>
                    <th>출력제한 초과</th>
                    <th>제출한 프로그램이 제한된 출력량 이상으로 결과를 출력했다는 의미입니다. 대부분의 경우 무한 반복 실행 구조에 의해 발생합니다. 채점 시스템의 출력 제한 바이트 수는 1M
                        bytes 입니다.</th>
                </tr>
                <tr>
                    <th>실행중 에러</th>
                    <th>제출한 프로그램이 실행되는 도중에 오류가 발생했다 의미입니다. 예를 들어, 'segmentation fault(허용되지 않는 메모리 영역에 접근하는 경우: 배열 인덱스 초과
                        등)','floating point exception(실수 계산 예외: 0 으로 나누는 등)','used forbidden functions(제한된 함수를 사용한 경우:
                        파일 처리 함수 등이 사용된 경우 등)', 'tried to access forbidden memories(허용되지 않는 시스템 메모리 영역 등에 접근하는 경우 등)' 등에
                        의해 발생합니다.</th>
                </tr>
                <tr>
                    <th>컴파일 에러</th>
                    <th>제출한 소스코드를 ANSI 표준(gcc/g++/gpc) 컴파일러로 컴파일하지 못했다는 의미입니다. 컴파일 오류 메시지가 아닌 오류 경고(warning)는 이 메시지를
                        출력하지 않습니다. 메시지 부분을 누르면 컴파일 오류 메시지를 확인할 수도 있습니다.</th>
                </tr>
            </tbody>
        </table>

        <h2>언어별 입출력 예시</h2>
        <p><strong>gcc (.c)</strong></p>
        <div class="ui existing segment">
            <pre style="margin-top: 0; margin-bottom: 0; ">
<code class="lang-c">#include &lt;stdio.h&gt;
int main(){
    int a, b;
    while(scanf("%d %d",&amp;a, &amp;b) != EOF){
        printf("%d\n", a + b);
    }
    return 0;
}</code></pre>
        </div>
        <p><strong>g++ (.cpp)</strong></p>
        <div class="ui existing segment">
            <pre style="margin-top: 0; margin-bottom: 0; ">
<code class="lang-c++">#include &lt;iostream&gt;
using namespace std;
int main(){
    // io speed up
    const char endl = '\n';
    std::ios::sync_with_stdio(false);
    cin.tie(nullptr);

    int a, b;
    while (cin &gt;&gt; a &gt;&gt; b){
        cout &lt;&lt; a+b &lt;&lt; endl;
    }
    return 0;
}</code></pre>
        </div>
        <p><strong>javac (.java)</strong></p>
        <div class="ui existing segment">
            <pre style="margin-top: 0; margin-bottom: 0; ">
<code class="lang-java">import java.util.Scanner;	
public class Main {
    public static void main(String[] args) {
        Scanner in = new Scanner(System.in);
        while (in.hasNextInt()) {
            int a = in.nextInt();
            int b = in.nextInt();
            System.out.println(a + b);
        }
    }
}</code></pre>
        </div>
        <p><strong>python3 (.py)</strong></p>
        <div class="ui existing segment">
            <pre style="margin-top: 0; margin-bottom: 0; ">
<code class="lang-c">import io
import sys
sys.stdout = io.TextIOWrapper(sys.stdout.buffer,encoding='utf8')
for line in sys.stdin:
    a = line.split()
    print(int(a[0]) + int(a[1]))</code></pre>
        </div>
    </div>
</div>

<?php include("template/$OJ_TEMPLATE/footer.php"); ?>