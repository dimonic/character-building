<? include("header.html"); ?>

<h2>Turn/Rebuke Undead</h2>

<h3>Existing System</h3>

<p>The problem (as I see it) with the existing procedure, is that it
can be very (too?)  powerful at low levels, and almost useless at mid
to high levels.  Many undead have more hit dice than their CR. Clerics
cannot turn an undead that has more than 4 more HD than their
level. There are several undead that exceed this at mid to high
levels.</p>

<p>Coupled with that is the fact that the mechanism resembles nothing
else in the game and requires a table look up every time it is
used.</p>

<h3>New System</h3>

<p>To "solve" the problem, I propose new rules for turning undead.</p>

<h3>Design Goals</h3>

<p>To replace any existing game mechanism, I have ambitious design
goals.  I am aware that gamers are a (small c) conservative bunch, by
and large.  It is a hassle to learn any new rule, even a simple
one. Therefore, any new rules had better be better than the ones they
replace, or I am going to hear about it from my gamers.</p>

<h4>Simplicity</h4>
<p>The system should be at least as simple as the existing system.</p>

<h4>Scaleability</h4>
<p>The system should scale, giving the cleric some turning chance against
most undead from existing sources, across all levels (1 through 20).</p>

<h4>Minimal Collateral Impact</h4>
<p>The system should require few or no changes to other rules, such as other
mechanisms that use turn checks, CR determinations for creatures etc.</p>

<h4>Game Balance</h4> <p>The system should not significantly increase
or decrease the power of classes that have the Turn Undead special
ability in an overall way (except where the power was effectively
non-existent due to poor design).</p>

<? include("turn-rules.html"); ?>

<h3>Analysis</h3>

<p>I have borrowed a <a
href="http://www.seankreynolds.com/rpgfiles/opinions/turningundead.html">table</a>
from Sean K. Reynolds' web site, where he has explored this issue. The
first 10 columns are his, verbatim. The next three columns are
examples using my proposed system. The first (of the new columns) "DC
in New System" is the turn DC calculated for the undead in
question. The next column, "% Success" is the chance of success for a
cleric of a level = CR of the undead, and a charisma of 12 to beat the
turn DC of the undead. The third new column "total per day number" is
the number of that type of undead that the cleric can turn in one
day.</p>

<table border="1"><tbody>
<tr><td style="font-weight: bold;"><small>Monster</small></td><td style="font-weight: bold;"><small>CR</small></td><td style="font-weight: bold;"><small>HD</small></td><td style="font-weight: bold;"><small>Turn<br>
Resistance</small></td><td style="font-weight: bold;"><small>Effective<br>
HD (EHD)</small></td><td style="font-weight: bold;"><small>EHD - CR</small></td><td style="font-weight: bold;"><small>Roll Needed</small></td><td style="font-weight: bold;"><small>% Success</small></td><td style="font-weight: bold;"><small>Average<br>
Turning<br>
Damage</small></td><td style="font-weight: bold;"><small>Number<br>
Turned</small></td><td style="font-weight: bold;"><small>DC in New<br>
System</small></td><td style="font-weight: bold;"><small>% Success</small></td><td style="font-weight: bold;"><small>Total per-<br>
day turnable</small></td>
</tr>
<tr><td><small>allip</small></td><td><small>3</small></td><td><small>4</small></td><td><small>2</small></td><td><small>6</small></td><td><small>3</small></td><td><small>19</small></td><td><small>10%</small></td><td><small>10</small></td><td><small>2.50</small></td>
<td>16</td><td>45%</td><td>2</td>
</tr>

<tr><td><small>bodak</small></td><td><small>8</small></td><td><small>9</small></td><td><small>0</small></td><td><small>9</small></td><td><small>1</small></td><td><small>13</small></td><td><small>40%</small></td><td><small>15</small></td><td><small>1.67</small></td>
<td>19</td><td>55%</td><td>3.5</td>
</tr>

<tr><td><small>devourer</small></td><td><small>11</small></td><td><small>12</small></td><td><small>0</small></td><td><small>12</small></td><td><small>1</small></td><td><small>13</small></td><td><small>40%</small></td><td><small>18</small></td><td><small>1.50</small></td>
<td>22</td><td>55%</td><td>3.75</td>
</tr>

<tr><td><small>ghast</small></td><td><small>3</small></td><td><small>4</small></td><td><small>2</small></td><td><small>6</small></td><td><small>3</small></td><td><small>19</small></td><td><small>10%</small></td><td><small>10</small></td><td><small>2.50</small></td>
<td>14</td><td>55%</td><td>3</td>
</tr>
<tr><td><small>ghost*</small></td><td><small>2</small></td><td><small>0</small></td><td><small>4</small></td><td><small>4</small></td><td><small>2</small></td><td><small>16</small></td><td><small>25%</small></td><td><small>9</small></td><td><small>--</small></td>
<td>14</td><td>50%</td><td>&infin;</td>
</tr>

<tr><td><small>ghost (10 HD base creature)</small></td><td><small>12</small></td><td><small>10</small></td><td><small>4</small></td><td><small>14</small></td><td><small>2</small></td><td><small>16</small></td><td><small>25%</small></td><td><small>19</small></td><td><small>1.90</small></td>
<td>20</td><td>60%</td><td>4.8</td>
</tr>

<tr><td><small>ghoul</small></td><td><small>1</small></td><td><small>2</small></td><td><small>2</small></td><td><small>4</small></td><td><small>3</small></td><td><small>19</small></td><td><small>10%</small></td><td><small>8</small></td><td><small>4.00</small></td>
<td>14</td><td>45%</td><td>2</td>
</tr>

<tr><td><small>lich*</small></td><td><small>2</small></td><td><small>0</small></td><td><small>4</small></td><td><small>4</small></td><td><small>2</small></td><td><small>16</small></td><td><small>25%</small></td><td><small>9</small></td><td><small>--</small></td>
<td>14</td><td>50%</td><td>&infin;</td>
</tr>

<tr><td><small>lich (11 HD base creature)</small></td><td><small>13</small></td><td><small>11</small></td><td><small>4</small></td><td><small>15</small></td><td><small>2</small></td><td><small>16</small></td><td><small>25%</small></td><td><small>20</small></td><td><small>1.82</small></td>
<td>25</td><td>50%</td><td>4.7</td>
</tr>

<tr><td><small>mohrg</small></td><td><small>8</small></td><td><small>14</small></td><td><small>0</small></td><td><small>14</small></td><td><small>6</small></td><td><small>Unturnable</small></td><td><small>0%</small></td><td><small>15</small></td><td><small>--</small></td>
<td>24</td><td>30%</td><td>2.3</td>
</tr>

<tr><td><small>mummy</small></td><td><small>5</small></td><td><small>8</small></td><td><small>0</small></td><td><small>8</small></td><td><small>3</small></td><td><small>19</small></td><td><small>10%</small></td><td><small>12</small></td><td><small>1.50</small></td>
<td>18</td><td>45%</td><td>2.5</td>
</tr>

<tr><td><small>nightshade, nightcrawler</small></td><td><small>18</small></td><td><small>25</small></td><td><small>0</small></td><td><small>25</small></td><td><small>7</small></td><td><small>Unturnable</small></td><td><small>0%</small></td><td><small>25</small></td><td><small>--</small></td>
<td>35</td><td>25%</td><td>2.9</td>
</tr>

<tr><td><small>nightshade, nightwalker</small></td><td><small>16</small></td><td><small>21</small></td><td><small>0</small></td><td><small>21</small></td><td><small>5</small></td><td><small>Unturnable</small></td><td><small>0%</small></td><td><small>23</small></td><td><small>--</small></td>
<td>31</td><td>35%</td><td>2.3</td>
</tr>

<tr><td><small>nightshade, nightwing</small></td><td><small>14</small></td><td><small>17</small></td><td><small>0</small></td><td><small>17</small></td><td><small>3</small></td><td><small>19</small></td><td><small>10%</small></td><td><small>21</small></td><td><small>1.24</small></td>
<td>27</td><td>45%</td><td>3.3</td>
</tr>

<tr><td><small>shadow</small></td><td><small>3</small></td><td><small>3</small></td><td><small>2</small></td><td><small>5</small></td><td><small>2</small></td><td><small>16</small></td><td><small>25%</small></td><td><small>10</small></td><td><small>3.33</small></td>
<td>15</td><td>50%</td><td>4</td>
</tr>

<tr><td><small>shadow, greater</small></td><td><small>8</small></td><td><small>9</small></td><td><small>2</small></td><td><small>11</small></td><td><small>3</small></td><td><small>19</small></td><td><small>10%</small></td><td><small>15</small></td><td><small>1.67</small></td>
<td>21</td><td>45%</td><td>3.6</td>
</tr>

<tr><td><small>skeleton, Medium (human)</small></td><td><small>1/2</small></td><td><small>1</small></td><td><small>0</small></td><td><small>1</small></td><td><small>0.5</small></td><td><small>10</small></td><td><small>55%</small></td><td><small>8</small></td><td><small>8.00</small></td>
<td>11</td><td>50%</td><td>4</td>
</tr>

<tr><td><small>skeleton, Medium (wolf)</small></td><td><small>1</small></td><td><small>1</small></td><td><small>0</small></td><td><small>1</small></td><td><small>0</small></td><td><small>10</small></td><td><small>55%</small></td><td><small>8</small></td><td><small>8.00</small></td>
<td>11</td><td>50%</td><td>4</td>
</tr>

<tr><td><small>skeleton, Large</small></td><td><small>2</small></td><td><small>5</small></td><td><small>0</small></td><td><small>5</small></td><td><small>3</small></td><td><small>19</small></td><td><small>10%</small></td><td><small>9</small></td><td><small>1.80</small></td>
<td>15</td><td>45%</td><td>1.6</td>
</tr>

<tr><td><small>spectre</small></td><td><small>7</small></td><td><small>7</small></td><td><small>2</small></td><td><small>9</small></td><td><small>2</small></td><td><small>16</small></td><td><small>25%</small></td><td><small>14</small></td><td><small>2.00</small></td>
<td>19</td><td>50%</td><td>4</td>
</tr>

<tr><td><small>vampire*</small></td><td><small>2</small></td><td><small>0</small></td><td><small>4</small></td><td><small>4</small></td><td><small>2</small></td><td><small>16</small></td><td><small>25%</small></td><td><small>9</small></td><td><small>--</small></td>
<td>14</td><td>50%</td><td>&infin;</td>
</tr>

<tr><td><small>vampire (5 HD base creature)</small></td><td><small>7</small></td><td><small>5</small></td><td><small>4</small></td><td><small>9</small></td><td><small>2</small></td><td><small>16</small></td><td><small>25%</small></td><td><small>14</small></td><td><small>2.80</small></td>
<td>19</td><td>50%</td><td>5.6</td>
</tr>

<tr><td><small>vampire (10 HD base creature)</small></td><td><small>12</small></td><td><small>10</small></td><td><small>4</small></td><td><small>14</small></td><td><small>2</small></td><td><small>16</small></td><td><small>25%</small></td><td><small>19</small></td><td><small>1.90</small></td>
<td>24</td><td>50%</td><td>4.8</td>
</tr>

<tr><td><small>vampire spawn</small></td><td><small>4</small></td><td><small>4</small></td><td><small>2</small></td><td><small>6</small></td><td><small>2</small></td><td><small>16</small></td><td><small>25%</small></td><td><small>11</small></td><td><small>2.75</small></td>
<td>16</td><td>50%</td><td>4</td>
</tr>

<tr><td><small>wight</small></td><td><small>3</small></td><td><small>4</small></td><td><small>0</small></td><td><small>4</small></td><td><small>1</small></td><td><small>13</small></td><td><small>40%</small></td><td><small>10</small></td><td><small>2.50</small></td>
<td>14</td><td>55%</td><td>3</td>
</tr>

<tr><td><small>wraith</small></td><td><small>5</small></td><td><small>5</small></td><td><small>2</small></td><td><small>7</small></td><td><small>2</small></td><td><small>16</small></td><td><small>25%</small></td><td><small>12</small></td><td><small>2.40</small></td>
<td>17</td><td>50%</td><td>4</td>
</tr>

<tr><td><small>wraith, dread**</small></td><td><small>11</small></td><td><small>16</small></td><td><small>0</small></td><td><small>16</small></td><td><small>5</small></td><td><small>Unturnable</small></td><td><small>0%</small></td><td><small>18</small></td><td><small>--</small></td>
<td>26</td><td>35%</td><td>2.75</td>
</tr>

<tr><td><small>zombie, Medium (human)<br>
      </small></td><td><small>1/2</small></td><td><small>2</small></td><td><small>0</small></td><td><small>2</small></td><td><small>1.5</small></td><td><small>13</small></td><td><small>40%</small></td><td><small>8</small></td><td><small>4.00</small></td>
<td>12</td><td>55%</td><td>&infin;</td>
</tr>

<tr><td><small>zombie, Medium (troglodyte)<br>
      </small></td><td><small>1</small></td><td><small>2</small></td><td><small>0</small></td><td><small>2</small></td><td><small>1</small></td><td><small>13</small></td><td><small>40%</small></td><td><small>8</small></td><td><small>4.00</small></td>
<td>12</td><td>55%</td><td>2</td>
</tr>

<tr><td><small>zombie, Large</small></td><td><small>2</small></td><td><small>6</small></td><td><small>0</small></td><td><small>6</small></td><td><small>4</small></td><td>Unturnable<br>
</td><td>0%<br>
</td><td><small>9</small></td><td>--<br></td>
<td>16</td><td>35%</td><td>1.5</td>
</tr>
</tbody>
</table>
</body>
<p><small><sup>*</sup> This is a template; the listed values are adjustments to the base creature's CR, HD, and Turn Resistance<br>
<sup>**</sup> The dread wraith doesn't have turn resistance even though the normal wraith does. Even without it, it's unturnable.</small><br>
</p>

<p>In the table, note that at all levels, the % chance of success is
generally increased significantly. In all cases where turning was
impossible, it can be accomplished in the new system at least 25% of
the time. I believe that this is something of a boost in power to the
cleric. Therefore (in the interest of game balance), I decided to
limit this power, by capping the total HD per day that the cleric can
turn, to CL &times; (Cha mod. + 3) (or CL &times; turn attempts per
day). This I think is a significant limitation compared to the open
ended situation before: a <em>lucky</em> cleric could turn the course
of a major battle with a few good turn attempts and lucky damage
rolls. With that limitation, the cleric trades the ability to turn so
many undead, for a better chance (or a chance at all) of turning
tougher undead, and better scaleability.</p>

<p>Note that for some prestige classes (in my experience, Knight of
the Chalice), the inherited turn ability has been almost useless: the
chance of turning a significant demon was almost nill under the
existing system, making the class ability next to useless. This
problem is exacerbated by the fact that the existing systems scales
badly, and prestige classes are not entered into until mid-levels.
</p>

<? include("footer.html"); ?>