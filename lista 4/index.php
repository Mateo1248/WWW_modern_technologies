<!DOCTYPE html>
<html lang="pl">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="UTF-8">
    <title>Zakamarki kryptografii</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="shortcut icon" href="favic.jpeg">

    <!--compatibility with older browsers versions and IE-->
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>

    <!--matjax configuraiton via global matjax object-->
    <script>
        window.MathJax = {
            tex: {
                //equation numbering
                tags: 'ams',
                //we can use two new markers
                inlineMath: [['$', '$'], ['\\(', '\\)']]
            }
        }
    </script>

    <!--download matjax via cdn-content delivery network-->
    <script type="text/javascript" id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
</head>
<body>
    <?php
    require_once 'config.php'; 

    if(!$logged) {
        header('Location: login.php'); 
    }
    ?>
    <header>
        <h1>Witaj! W tym artykule dowiesz się bardzo ciekawych rzeczy z działu kryptografii.</h1>
    </header>

    <main>
        <h1>
            <b>1. Algorytm szyfrowania probabilistycznego Goldwasser-Micali</b>
        </h1>
        <article>
            <b>Algorytm generowania kluczy:</b>

            <ol type="a">
              <li>Wybierz losowo dwie duże liczby pierwsze $p$ oraz $q$ (podobnego rozmiaru),</li>
              <li>Policz $n = pq$,</li>
              <li>Wybierz $y$ $\in$ $\mathbb{Z}_{n}$, takie, że $y$ jest nieresztą kwadratwą modulo $n$ i symbol Jacobiego ($\frac{y}{n}$) $= 1$ (czyli $y$ jest pseudokwadratem modulo $n$).</li>
              <li>Klucz publiczny stanowi para $(n, y)$, zaś odpowiadający mu klucz prywatny to para $(p, q)$.</li>
            </ol>

            <b>Algorytm szyfrowania:</b>
            <br><br>    

          Chcąc zaszyfrowac wiadomść $m$ przy użyciu klucza publicznego $(n, y)$ wykonaj kroki:

            <ol type="a">
                <li>Przedstaw $m$ w postaci łańcucha binarnego $m = m_{1}m_{2}...m_{t}$ długości $t$</li>
                <li>For $i$ from $1$ to $t$ do <br>
                    $\quad$ wybierz losowe $x$ $\in$ $\mathbb{Z}^{*}_{n}$ <br>
                    $\quad$ If $m_{i}$ $=$ 1 then set $c_{i}$ $\leftarrow$ $yx^{2}\mod n$ <br>
                    $\quad$ Otherwise set $c_{i}$ $\leftarrow$ $x^{2} \mod n$ <br></li>
                <li>Kryptogram wiadomości $m$ stanowi $c = (c_{1}, c_{2},..., c_{t})$</li>
            </ol>

            <b>Algorytm deszyfrowania:</b>
            <br>
            <br>
            Chcąc odzyskać wiadomość z kryptogramu $c$ przy użyciu klucza prywatnego nego $(p, q)$ wykonaj kroki:
            
            <ol type="a">
                <li>For $i$ from $1$ to $t$ do <br>
                    $\quad$ policz symbol Legendre'a $e_{i}$ $=$ $(\frac{c_{i}}{p})$ <br>
                    $\quad$ If $e_{i}$ $=$ 1 then set $m_{i}$ $\leftarrow$ $0$ <br>
                    $\quad$ Otherwise set $m_{i}$ $\leftarrow$ $1$ <br></li>
                <li>Zdeszyfrowana wiadomość to $m = m_{1}m_{2}...m_{t}$.</li>
            </ol>
        </article>
        <h1>
            <b>2. Reszta/niereszta kwadratowa</b>
        </h1>
        <article>
            <b>Definicja.</b> Niech $a$ $\in$ $\mathbb{Z}_{n}$. Mówimy, że $a$ jest resztą kwadratową modulo $n$
            (kwadratem modulo $n$), jeżeli istnieje $x$ $\in$ $\mathbb{Z}^{*}_{n}$, takie, że
            $x^{2}$ $\equiv$ $a(\mod p)$.
            Jeżeli takie $x$ nie istnieje, to wówczas $a$ nazywamy nieresztą kwadratową
            modulo $n$. Zbiór wszystkich reszt kwadratowych modulo $n$ oznaczamy
            $Q_{n}$, zaś zbiór wszystkich niereszt kwadratowych modulo $n$ oznaczamy $\bar{Q}_{n}$.

        </article>

        <h1>
            <b>3. Symbol Legendre’a i Jacobiego</b>
        </h1>
        <article>
            <b>Definicja.</b> Niech $p$ będzie nieparzystą liczbą pierwszą, a $a$ liczbą całkowitą. <br>
            $\textit{Symbol Legendre'a}$ $\big(\frac{a}{p}\big)$ jest zdefiniowany jako:
            $$
            \Bigg(\frac{a}{p}\Bigg) = \left\{
            \begin{array}{ll}
            \quad 0 & \textrm{ jeśli } p|a\\
            \quad 1 & \textrm{ jeśli } x \in Q_{p}\\
            \quad-1 & \textrm{ jeśli }x \in \bar{Q}_{p}
            \end{array}
            \right.
            $$


            <b>Własnosci symbolu Legendre'a. </b> Niech $a$, $b$ $\in$ $\mathbb{Z}$, zaś $p$ to nieparzysta liczba
            pierwsza. Wówczas: <br>
            <ul>
                <li>$\bigg(\frac{a}{p}\bigg)$ $\equiv$ $a^{\frac{(p-1)}{2}}$$(\mod p$)</li>
                <li>$\bigg(\frac{ab}{p}\bigg)$ $=$ $\bigg(\frac{a}{p}\bigg)$ $\bigg(\frac{b}{p}\bigg)$</li>
                <li>$a$ $\equiv$ $b$ (mod $p$) $\Longrightarrow$ $\bigg(\frac{a}{p}\bigg)$ $=$ $\bigg(\frac{b}{p}\bigg)$</li>
                <li>$\bigg(\frac{2}{p}\bigg)$ $=$ $(-1)^{\frac{(p^{2}-1)}{8}}$</li>
                <li>Jeżeli $q$ jest nieparzystą liczbą pierwszą inną od $p$ to:
                    $$\bigg(\frac{p}{q}\bigg) = \bigg(\frac{q}{p}\bigg)(-1)^{\frac{(p-1)(q-1)}{4}}$$
                </li>
            </ul>

            <b>Definicja. </b> Niech $n$ $\geqslant$ $3$ będzie liczbą nieparzystą a jej rozkład na czynniki pierwsze to
            $n$ $=$ $p^{e_{1}}_{1}$$p^{e_{2}}_{2}$$\dots$$p^{e_{k}}_{k}$.
            $\textit{Symbol Jacobiego}$ $(\frac{a}{n})$ jest zdefiniowany jako:

            $$\bigg(\frac{a}{n}\bigg) = \bigg(\frac{a}{p_{1}}\bigg)^{e_{1}} \bigg(\frac{a}{p_{2}}\bigg)^{e_{2}} \dots \bigg(\frac{a}{p_{k}}\bigg)^{e_{k}}$$

            Jeżeli $n$ jest liczbą pierwszą, to symbol Jacobiego jest symbolem Legendre'a. <br> <br>
            <b>Własności symbolu Jacobiego.</b> Niech $a$, $b$ $\in$ $\mathbb{Z}_{n}$, zaś $m$, $n$ $\geqslant$ $3$ to nieparzyste liczby całkowite. Wówczas:

            <ul>
                <li>$\bigg(\frac{a}{n}\bigg)$ $=$ $0,1$, albo $-1$. Ponadto $\bigg(\frac{a}{n}\bigg)$ $=$ $0$ $\Longleftrightarrow$ $gcd$($a, n$) $\neq$ $1$</li>
                <li>$\bigg(\frac{ab}{n}\bigg)$ $=$ $\bigg(\frac{a}{n}\bigg)$ $\bigg(\frac{b}{n}\bigg)$</li>
                <li>$\bigg(\frac{a}{mn}\bigg)$ $=$ $\bigg(\frac{a}{m}\bigg)$ $\bigg(\frac{a}{n}\bigg)$</li>
                <li>$a$ $\equiv$ $b$ ($\mod n$) $\Longrightarrow$ $=$ $\bigg(\frac{a}{n}\bigg)$ $=$ $\bigg(\frac{b}{n}\bigg)$</li>
                <li>$\bigg(\frac{1}{n}\bigg)$ $=$ $1$</li>
                <li>$\bigg(\frac{-1}{n}\bigg)$ $=$ $(-1)^{\frac{(n-1)}{2}}$</li>
                <li>$\bigg(\frac{2}{n}\bigg)$ $=$ $(-1)^{\frac{(n^{2}-1)}{8}}$</li>
                <li>$\bigg(\frac{m}{n}\bigg)$ $=$ $\bigg(\frac{n}{m}\bigg)$$(-1)^{\frac{(m-1)(n-1)}{4}}$</li>
            </ul>
            <br>

            Z własności symbolu Jacobiego wynika, że jeśli $n$ jest nieparzyste oraz $a$ nieparzyste i w postaci $a$ $=$ $2^{e}$$a_{1}$, gdzie
            $a_{1}$ też nieparzyste to:

            $$\bigg(\frac{a}{n}\bigg) = \bigg(\frac{2^{e}}{n}\bigg) \bigg(\frac{a_{1}}{n}\bigg) = \bigg(\frac{2}{n}\bigg)^{e} \bigg(\frac{n \mod a_{1}}{a_{1}}\bigg) (-1)^{\frac{(a_{1}-1)(n-1)}{4}}$$

            <b>Algorytm obliczania symbolu Jacobiego.</b> $(\frac{a}{n})$ dla nieparzystej liczby całkowitej $n$$\geqslant$$3$ oraz całkowitego 0$\leqslant$$a$$<$$n$

            <br><br>JACOBI(a, n)  <br>
            $\quad$ $(a)$  If $a$$=$0 then return 0<br>
            $\quad$ $(b)$  If $a$$=$0 then return 1<br>
            $\quad$ $(c)$  Write $a$ $=$ $2^{e}$$a_{1}$, gdzie $a_{1}$ nieparzyste<br>
            $\quad$ $(d)$  If $e$ parzyste set $s$ $\leftarrow$ 1<br>
             $\quad$ $\quad$ $\quad$ Otherwise  $s$ $\leftarrow$ 1 if $n$ $\equiv$ 1 or $7$($\mod 8$), or set <br>
            $\quad$ $\quad$ $\quad$ $s$ $\leftarrow$ -1 if $n$ $\equiv$ 3 or $5$($\mod 8$) <br>
            $\quad$ $(e)$  If $n$ $\equiv$ 3 ($\mod 4$) and $a_{1}$ $\equiv$ 3 ($\mod 4$) then set $s$ $\leftarrow$ $-s$ <br>
            $\quad$ $(f)$  Set $n_{1}$ $\leftarrow$ $n$ $\mod a_{1}$<br>
            $\quad$ $(g)$  If $a_{1}$ $=$ 1 then return $s$<br>
            $\quad$ $\quad$ $\quad$ Otherwise return $s$$\cdot$$JACOBI(n_{1}, a_{1})$ <br><br>


            $\quad$ Algorytm działa w czasie $\mathcal{O}$$(($lg$n)^{2})$ operacji bitowych.
        </article>

        <h1>
            <b>4. Schemat progowy</b> $(t, n)$ <b>dzielenia sekretu Shamira</b>
        </h1>
        <article>
            <b>Cel:</b> Zaufana Trzecia Strona $T$ ma sekret $S$ $>$ $0$, który chce podzielić pomiędzy
            $n$ uczestników tak, aby dowolnych $\quad$ $t$ sposród nich mogło sekret odtworzyć. <br><br>

            <b>Faza inicjalizacji:</b> Zaufana Trzecia Strona $T$ ma sekret $S$ $>$ $0$, który chce podzielić pomiędzy
            $n$ uczestników tak, $\quad$ aby dowolnych $t$ sposród nich mogło sekret odtworzyć. <br>

            <ul>
                <li>$T$ wybiera liczbę pierwszą $p$ $>$ max($S$, $n$) i definiuje $a_{0}$ $=$ $S$,</li>
                <li>$T$ wybiera losowo i niezależnie $t-1$ współczynników $a_{1}$, $...$, $a_{t-1}$ $\in$ $\mathbb{Z}_{p}$,</li>
                <li>
                    $T$ definiuje wielomian nad $\mathbb{Z}_{p}$:
                    \begin{equation}
                        f(x) = a_{0} + \sum_{j=1}^{t-1} a_{j}x^{j} ,
                    \end{equation}
                </li>
                <li>
                    Dla $1$ $\leqslant$ $i$ $\leqslant$ $n$ Zaufana Trzecia Strona $T$ wybiera losowo $x_{i}$ $\in$ $\mathbb{Z}_{p}$, oblicza: $S_{i}$ $=$ $f$($x_{i}$) $\mod p$ i bezpiecznie $\quad$ $\quad$ przekazuje parę $(x_{i}, S_{i})$ użytkownikowi $P_{i}$.
                </li>
            </ul>

            <br><br>
            <b>Faza łączenia wielomianów w sekret: </b> Dowolna grupa $t$ lub więcej uzytkowników
            łączy swoje udziały $-$ $t$ różnych $\quad$
            punktów $(x_{i}, S_{i})$  wielomianu $f$ i dzięki
            interpolacji Lagrange'a odzyskuje sekret $S$ $=$ $a_{0}$ $=$ $f$($0$).
            <br>
        </article>


        <h1>
            <b>5. Interpolacja Lagreange'a</b>
        </h1>
        <article>
            Mając dane $t$ różnych punktów $(x_{i}, y_{i})$ nieznanego wielomianu $f$ stopnia mniejszego od $t$ możemy policzyć jego współczynniki korzystając ze wzoru:
            \begin{equation}
            f(x) = \sum_{j=1}^{t}\bigg(y_{i} \prod_{1 \leqslant j \leqslant t, j \neq i} \frac{x-x_{j}}{x_{i}-x{j}} \bigg)\mod p,
            \end{equation}

            <b>Wskazówka:</b> w schemacie Shamira, aby odzyskac sekret $S$, użytkownicy nie muszą znać całego wielomianu $f$. Wstawiając
            do wzoru na interpolację Lagrange’a $x$ $=$ $0$, dostajemy wersję uproszczoną, ale wystarczającą, aby policzyć
            sekret $S$ $=$ $f$($0$):

            \begin{equation}
            f(x) = \sum_{j=1}^{t}\bigg(y_{i} \prod_{1 \leqslant j \leqslant t, j \neq i} \frac{x_{j}}{x_{j}-x{i}} \bigg) \mod p,
            \end{equation}
        </article>

        <h1>
            <b>6. Przykład dzielenia sekretu Shamira</b>
        </h1>
        <article>
            Naszym sekretem będzie $S = 82$, który chcemy podzielić pomiędzy $n=4$ użytkowników, a $t=2$ z nich może ten sekret odtworzyć, wybieramy również liczbę pierwszą
            $p>max(S,n)$, niech $p=401$, teraz wszystkie obliczenia będziemy wykonywać nad ciałem $\mathbb{Z}_{p}$.<br>
            Mamy wielomian $f(x) = 82 + 10x$.<br>
            Teraz tworzymy 4 pary wielomainu postaci $(x_i, f(x_i))$ nad $\mathbb{Z}_{p}$. <br>


            \begin{array}{c|c|c} 
            i & x_i & f(x_i) \mod p\\
            \hline
            1&4&122\\
            2&1&92\\
            3&3&112\\
            4&8&162\\
            \end{array}


            Wystarczą nam 2 pary do obliczenia wielomianu Lagreange'a, weźmy drugą oraz trzecią.
            Po podstawieniu do wzoru $(2)$ mamy:
            $$
            f(x)=92\bigg( \frac{x-3}{1-3} \bigg) + 112\bigg( \frac{x-1}{3-1} \bigg)=82=10x
            $$
            Wiemy również, że $f(0) = S$, teraz obliczając $f(0)=82$ mamy nasz sekret.
        </article>
    </main>
</body>
</html>