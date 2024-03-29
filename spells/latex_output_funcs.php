<?php
  require_once("../phplib/connect.inc.php");
  require_once("../phplib/lib.inc.php");

  function setPDFHEaders($filename)
  {
    header("Pragma: public");
    header("Expires: 0"); // set expiration time
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: application/pdf");
    header("Content-Disposition: inline; filename=$filename");
    header("Content-Transfer-Encoding: binary");
  }

  function latex_preamble($title)
  {

    global $latex_doc;

    $latex_doc .= '\documentclass[letterpaper,11pt]{article}
\usepackage[body={8in,10.5in}]{geometry}
\usepackage{latexsym}
\usepackage{shading}
\usepackage{colortbl}
\usepackage{longtable}

\newcommand{\boxstrut}{\rule[-.0125in]{0in}{.175in}}
\newcommand{\rowstrut}{\rule[-.050in]{0in}{.125in}}
\newcommand{\tabspace}{\vspace{-.3in}}

\title{}

\author{Dominic A. V. Amann}

\begin{document}

\sffamily{

\newlength{\oldtabcolsep}
\setlength{\oldtabcolsep}{\tabcolsep}
\setlength{\tabcolsep}{0in}

\scriptsize

\parashade[.75]{sharpcorners}{\centering{\textbf{\large{';
    $latex_doc .= "$title";
    $latex_doc .= '\rowstrut }}}}

';

  }

  function latex_wizard_DC_tables ($special, $prohibited1, $prohibited2)
  {
    global $latex_doc;

    $latex_doc .= '\begin{tabular}{l r}
{ % left table (spells by level)
\begin{tabular}{r *{10}{p{.25in}}}
\cline{2-11}
\textbf{SPELLS PER DAY} \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut  \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline \\\\
\cline{2-11}
\textbf{BONUS SPELLS} \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut  \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline \\\\
\cline{2-11}
\textbf{LEVEL} \boxstrut \hspace{\oldtabcolsep} & \hspace{.0625in}0 & \hspace{.0625in}1 & \hspace{.0625in}2 & \hspace{.0625in}3 & \hspace{.0625in}4 & \hspace{.0625in}5 & \hspace{.0625in}6 & \hspace{.0625in}7 & \hspace{.0625in}8 & \hspace{.0625in} 9 \\\\
\cline{2-11} 
\textbf{SPELL SAVE DC} \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut  \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline \\\\
\cline{2-11}
\end{tabular}
}
&
\setlength{\tabcolsep}{1.5pt}

{ % right tables schools and ranges
\begin{tabular}{r l}
\textbf{SPEC. SCHOOL} & ' . $special . '\\\\

\textbf{PROHIBITED} & ' . "$prohibited1 $prohibited2" . '\\\\

\textbf{RANGES} &
\begin{tabular}{c c c c c}
\tiny{CLOSE} & \hspace{.25in} & \tiny{MEDIUM} & \hspace{.25in} & \tiny{LONG} \\\\
\framebox[.5in]{\boxstrut } & \hspace{.25in} & \framebox[.5in]{\boxstrut} & \hspace{.25in} & \framebox[.5in]{\boxstrut} \\\\
\tiny{25 ft + 5 ft/2 levels} & \hspace{.25in} & \tiny{100 ft + 10 ft/2 levels} & \hspace{.25in} & \tiny{400 ft + 40 ft/level} \\\\
\end{tabular} \\\\
\end{tabular}
} \\\\
\end{tabular}
';

  }

  function latex_other_DC_tables ()
  {
    global $latex_doc;

    $latex_doc .= '\begin{tabular}{l r}
{ % left table (spells by level)
\begin{tabular}{r *{10}{p{.25in}}}
\cline{2-11}
\textbf{SPELLS PER DAY} \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut  \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline \\\\
\cline{2-11}
\textbf{BONUS SPELLS} \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut  \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline \\\\
\cline{2-11}
\textbf{LEVEL} \boxstrut \hspace{\oldtabcolsep} & \hspace{.0625in}0 & \hspace{.0625in}1 & \hspace{.0625in}2 & \hspace{.0625in}3 & \hspace{.0625in}4 & \hspace{.0625in}5 & \hspace{.0625in}6 & \hspace{.0625in}7 & \hspace{.0625in}8 & \hspace{.0625in} 9 \\\\
\cline{2-11} 
\textbf{SPELL SAVE DC} \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut  \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline \\\\
\cline{2-11}
\end{tabular}
}
&
\setlength{\tabcolsep}{1.5pt}

{ % right table ranges

\begin{tabular}{r c}
\textbf{RANGES} &
\begin{tabular}{c c c c c}
\tiny{CLOSE} & \hspace{.25in} & \tiny{MEDIUM} & \hspace{.25in} & \tiny{LONG} \\\\
\framebox[.5in]{\boxstrut } & \hspace{.25in} & \framebox[.5in]{\boxstrut} & \hspace{.25in} & \framebox[.5in]{\boxstrut} \\\\
\tiny{25 ft + 5 ft/2 levels} & \hspace{.25in} & \tiny{100 ft + 10 ft/2 levels} & \hspace{.25in} & \tiny{400 ft + 40 ft/level} \\\\
\end{tabular} \\\\
\end{tabular}
} \\\\
\end{tabular}
';

  }

  function latex_cleric_DC_Tables ($domain1, $domain2, $domain3, $domain4)
  {
    global $latex_doc;

    if ("$domain1" != '') {
      $query = "SELECT * FROM `domain` WHERE `name` = '$domain1'";
      $result = issue_query($query);
      $domain_row[1] = $result->fetchRow(DB_FETCHMODE_ASSOC);
      if (DB::isError($domain_row)) {
      	die($domain_row->getMessage());
      }
    }
    if ("$domain2" != '') {
      $query = "SELECT * FROM `domain` WHERE `name` = '$domain2'";
      $result = issue_query($query);
      $domain_row[2] = $result->fetchRow(DB_FETCHMODE_ASSOC);
      if (DB::isError($domain_row)) {
      	die($domain_row->getMessage());
      }
    }
    if ("$domain3" != '') {
      $query = "SELECT * FROM `domain` WHERE `name` = '$domain3'";
      $result = issue_query($query);
      $domain_row[3] = $result->fetchRow(DB_FETCHMODE_ASSOC);
      if (DB::isError($domain_row)) {
      	die($domain_row->getMessage());
      }
    }
    if ("$domain4" != '') {
      $query = "SELECT * FROM `domain` WHERE `name` = '$domain4'";
      $result = issue_query($query);
      $domain_row[4] = $result->fetchRow(DB_FETCHMODE_ASSOC);
      if (DB::isError($domain_row)) {
      	die($domain_row->getMessage());
      }
    }
    $latex_doc .= '\begin{tabular}{l r}
{ % left table (spells by level)
\begin{tabular}{r *{10}{p{.25in}}}
\cline{2-11}
\textbf{SPELLS PER DAY} \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut  \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline \\\\
\cline{2-11}
\textbf{BONUS SPELLS} \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut  \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline \\\\
\cline{2-11}
\textbf{LEVEL} \boxstrut \hspace{\oldtabcolsep} & \hspace{.0625in}0 & \hspace{.0625in}1 & \hspace{.0625in}2 & \hspace{.0625in}3 & \hspace{.0625in}4 & \hspace{.0625in}5 & \hspace{.0625in}6 & \hspace{.0625in}7 & \hspace{.0625in}8 & \hspace{.0625in} 9 \\\\
\cline{2-11} 
\textbf{SPELL SAVE DC} \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut  \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline & \hfill \boxstrut \vline \\\\
\cline{2-11}

\textbf{RANGES} \boxstrut \hspace{\oldtabcolsep} &
\begin{tabular}{c c c c c}
\tiny{CLOSE} & \hspace{.25in} & \tiny{MEDIUM} & \hspace{.25in} & \tiny{LONG} \\\\
\framebox[.5in]{\boxstrut } & \hspace{.25in} & \framebox[.5in]{\boxstrut} & \hspace{.25in} & \framebox[.5in]{\boxstrut} \\\\
\tiny{25 ft + 5 ft/2 levels} & \hspace{.25in} & \tiny{100 ft + 10 ft/2 levels} & \hspace{.25in} & \tiny{400 ft + 40 ft/level} \\\\
\end{tabular} \\\\

\end{tabular}
}
&
\setlength{\tabcolsep}{4pt}
{ % right tables schools and ranges
\begin{tabular}{r l}
\textbf{DOMAIN} & ';
    $latex_doc .= "$domain1";
    $latex_doc .= '\hspace{2.5in} \\\\
\cline{2-2}
\textbf{GRANTED POWER} \boxstrut & ';
    $latex_doc .= "{$domain_row[1][power]}";
    $latex_doc .= '\hspace{2.5in} \\\\
\cline{2-2}
\textbf{DOMAIN} \rule[-.05in]{0in}{.25in} & ';
    $latex_doc .= "$domain2";
    $latex_doc .= '\hspace{2.5in} \\\\
\cline{2-2}
\textbf{GRANTED POWER} \boxstrut & ';
    $latex_doc .= "{$domain_row[2][power]}";
    $latex_doc .= '\hspace{2.5in} \\\\
\cline{2-2}
\textbf{PRESTIGE DOMAIN} \rule[-.05in]{0in}{.25in} & ';
    $latex_doc .= "$domain3 $domain4";
    $latex_doc .= '\hspace{2.5in} \\\\
\cline{2-2}
\textbf{GRANTED POWER} \boxstrut & ';
    $latex_doc .= "{$domain_row[3][power]} {$domain_row[4][power]}";
    $latex_doc .= '\hspace{2.5in} \\\\
\cline{2-2}

\end{tabular}
} \\\\
\end{tabular}
';

  }

  function latex_start_table($cclass)
  {
    global $latex_doc;

    $latex_doc .= '\setlength{\tabcolsep}{1.75pt}
';
    if ("$cclass" == "sorcerer" || "$cclass" == "wizard") {
      $latex_doc .= '\begin{longtable}{p{.125in} r r p{1.05in} p{1.60in} l p{.4in} l l p{1.30in} p{.7in} l l p{.25in}}' . "\n";
    } else {
      $latex_doc .= '\begin{longtable}{p{.125in} r r p{1.05in} p{1.60in} l l l p{1.60in} p{.7in} l l p{.25in}}' . "\n";
    }
  }

  function latex_end_table()
  {

    global $latex_doc;
    $latex_doc .= '\end{longtable}
\tabspace
';

  }

  function latex_row ($row, $num, $cclass)
  {

    global $latex_doc;

    if (floor(($num - 1) / 3) % 2) {
      $latex_doc .= '\rowcolor[gray]{.80} ';
    }

    $latex_doc .= '\underline{\ \ \ \ } & ';
    $latex_doc .= "$num";
    $latex_doc .= ' & \raisebox{.5ex}{\fbox{}} & ';

    foreach ($row as $key => $value) {
      $row[$key] = addcslashes($value, "%");
    }
    $exp = ($row[exp_components] != "") ? "$^{ $row[exp_components] }$" : "";
    if ($cclass == "sorcerer" || $cclass == "wizard") {
      $latex_doc .= " \\raggedright{ $row[name]$exp } & \\raggedright{ $row[description] } & $row[school] & ";
      $components = str_replace("F/DF", "F", str_replace("M/DF", "M", $row[components]));
    } else { // no school for clerics
      $latex_doc .= " \\raggedright{ $row[name]$exp } & \\raggedright{ $row[description] } & ";
      $components = str_replace("F/DF", "DF", str_replace("M/DF", "DF", $row[components]));
    }
    if (strlen($components) > 7) {
      $components = ereg_replace('([^,]*,[^,]*,[^,]*),', '\1 ', $components);
    }
    $latex_doc .= " $components  & $row[time] & $row[range] & \\raggedright{ $row[target] } & $row[duration] & $row[save] & $row[spell_resistance] & ";
    $latex_doc .= stristr($row[source], 'PH') ? "$row[page]" : str_replace('"', '', "$row[source]");
    $latex_doc .= "\\\\\n";
  }

  function latex_postamble()
  {
    global $latex_doc;

    $latex_doc .= '}

\end{document}
';

  }

  function latex_level_header($level, $cclass)
  {
    global $latex_doc;

    if ("$cclass" == "wizard" || "$cclass" == "sorcerer") {
      $latex_doc .= '\multicolumn{14}{c}{\textbf{\small{';
      $latex_doc .= "$level";
      $latex_doc .= '}} \boxstrut }\\\\
\rowcolor[gray]{.75} \rowstrut & & & Spell & Description & School & Comp & Time & Range & Target, Effect, Area & Duration & Save & SR & PHB \\\\
';
    } else {
      $latex_doc .= '\multicolumn{13}{c}{\textbf{\small{';
      $latex_doc .= "$level";
      $latex_doc .= '}} \boxstrut }\\\\
\rowcolor[gray]{.75} \rowstrut & & & Spell & Description & Comp & Time & Range & Target, Effect, Area & Duration & Save & SR & PHB \\\\
';
    }
  }
?>