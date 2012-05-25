<html>
<head>
<title>Battle</title>
<!-- <link rel="stylesheet" type=text/css href="../styles/default.css" title="php-style">
<link rel="stylesheet" type=text/css href="../styles/dndnew2004.css" title="php-style"> -->

<link rel="stylesheet" type=text/css href="../styles/php-home-style.css" title="php-style">
</head>
<body>

<h1>Integrating battles into Dungeons and Dragons</h1>

<h2>Overview</h2>

  <p>These are rules intended to integrate PCs (and anti-heroes) into
  medium and large scale battles.</p>

  <p>The design focuses on moving the large scale stuff along swiftly,
  and focussing on the character actions as much as possible.</p>

  <p>Here are some of the key design considerations for the battle
  resolution system.</p>

  <h4>Design Considerations</h4>

  <ul>
    <li>speedy resolution</li>

    <p>at least 75% of the 'face-time' should be spent resolving
    PC and anti-hero activities.</p>

    <li>simple</li>

    <p>the new rules should require a minimum of look-ups, die rolling
    or calculation.</p>

    <li>easy integration</li>

    <p>existing rules wil be used for all PC and anti-hero
    actions.</p>

    <li>large scale action-results not forced on PCs</li>

    <p>Such as unit losses from large scale action. The system will
    use morale and initiative modifiers caused by large-scale action
    results to modify PC bonuses.</p>

    <li>PCs have the opportunity for a significant impact on outcome</li>

    <p>the rules will use intiative and morale modifiers based on PC
    abilities and levels that will modify troop unit values when PCs
    are embedded or commanding them.</p>

    <p>Additionally, sucessful (or unsuccessful) outcome of specific
    PC actions will modify unit initiative and/or morale.</p>

  </ul>

<h2>Rules</h2>

  <p>Two major concepts lie at the heart of this simple system. Both
  are complementary scaling effects, one for distance, the other for
  time.</p>

  <h3><a name='scale'>Scale</a></h3>

    <p>At the outset, the DM must decide on an appropriate scale for
    the grand battle. This choice depends on the size of engagement,
    expressed as the number of soldiers on each side that are to be
    represented. This number could be in the thousands, or as few as a
    hundred a side and still practical for this system. The choice of
    scale will govern how many individuals per 'unit' are directly
    controlled at the game level. For example, on a typical battlemat,
    a scale of 50 ft per square will allow for units of 100 men to be
    controlled as one, and a battlefield of 1000 &times; 1500 ft. A
    scale of 25 ft per square would allow groups of 25 men per unit,
    and an overall battlefield of 500 &times 750 ft.<p>

  <h3>Battle round</h3>

    <p>The length of a 'battle round' depends upon the scale chosen. A
    battle round will be <font color='red'>n</font> DnD combat rounds,
    where <font color='red'>n</font> is the multiplier for the 5 ft
    square chosen above. For example, if 50 ft squares are chosen,
    <font color='red'>n</font> will be 10 (50 / 5). In game terms, for
    every 10 rounds of normal character activity, 1 round of battle
    resolution is carried out. Similarly, if the scale is to be 10 ft
    squares (with each unit being a squad of 4 or so men), then battle
    rounds will occur every second combat round.</p>

  <h3>Separate maps</h3>

    <p>For a particular battle, one main battle map must be
    maintained, and other, subsidiary maps may be needed for
    individual actions by PCs and other heroic types. The main battle
    map is at the scale above, whereas as the subsidiary maps are of
    normal DnD scale. <font color='red'>n</font> turns of combat on a subsidiary map
    will elapse for one single battle-map turn.</p>

  <h3>Command structure</h3>

    <h4><a name='points'>Command points</a></h4>

    <p>This is a new term that attempts to model realistic limitations
    on battle situation command and control abilities. It will limit
    each side's actions based on a pool of command points available to
    it on it's action.</p>

    <h4 Command point determination</h4>

    <table>
      <tr><th class='left'>Situation</th><th class='left'>Command points</th></tr>

      <tr><td class='left'>per level of overall commander</td><td> +1 </td></tr>

      <tr><td class='left'>overall commander has leadership feat</td><td> +4 </td></tr>

      <tr><td class='left'>per commander with leadership</td><td> +2 </td></tr>

      <tr><td class='left'>commander has 5 ranks in Knowledge (battle)</td><td> +2 </td></tr>

      <tr><td class='left'>per spellcaster on the side</td><td> +1 </td></tr>

      <tr><td class='left'>defending fixed position</td><td> &times; 1.5 </td></tr>

      <tr><td class='left'>bard attached to commander</td><td> + bard level / 2 </td></tr>

      <tr><td class='left'>musician unit</td><td> +4 </td></tr>

      <tr><td class='left'>herald/standard bearer attached to units</td><td>
      +1 per herald<sup>*</sup> </td></tr>

      <tr><td class='left'>known terrain</td><td> &times; 1.5 </td></tr>

    </table>

    <p><sup>*</sup>Maximum 1 per unit.</p>

    <p>The overall commander will allocate his share of points among
    his various subordinates, who will in turn allocate command points
    down to individual units. PCs will never be restricted by command
    points in their individual actions.</p>


  <h3>Unit rules</h3>

    <h4>Unit status</h4>

    <p>Each unit (an arbitrary grouping of individual creatures and/or
    weapons or other units) will have certain battle resolution
    statistics connected with it. These statistics are typically
    aggregates or abstracts of existing DnD statistics.</p>

      <h5>Unit Damage</h5>

      <p>A unit that takes damage may change status as follows: each
      failed save moves the unit one status worse:

      <em>normal, shaken, disorganized, frightened, panicked.</em>

      Units that exceed 25% losses automatically become less combat
      effective, as illustrated by the negative levels.

      A disorganized unit may only defend itself when attacked, and
      may not act other than to move away from combat at normal
      movement (at the player's discretion).</p>

      <table>

      <tr>
        <th class='left'>Situation</th>
	<th class='left'>Morale save<sup>1</sup></th>
	<th class='left'>Condition</th>
      </tr>
      <tr>
        <td class='left'>First damage this battle</td> 
	<td class='left'>Will DC 10</td>
	<td class='left'>Normal</td>
      </tr>
      <tr>
        <td class='left'>10% damage</td> 
	<td class='left'>Will DC 10</td>
	<td class='left'>Normal</td>
      </tr>
      <tr>
	<td class='left'>25% damage</td>
	<td class='left'>Will DC 15</td>
	<td class='left'>1 negative level<sup>2</sup></td>
      </tr>
      <tr>
	<td class='left'>50% damage</td>
	<td class='left'>Will DC 20</td>
	<td class='left'>2 negative levels<sup>2</sup></td>
      </tr>
      <tr>
        <td class='left'>75% damage</td>
	<td class='left'>Will DC 25</td>
	<td class='left'>3 negative levels<sup>2</sup></td>
      </tr>
      </table>

      <p><sup>1</sup> Modifiers to morale saves: if the unit cannot
      reply to the attacks, -2. If the damage is from magical attacks,
      -2. If the unit has just taken damage from a charge, -2
      (cumulative).</p>

      <p><sup>2</sup> A unit whose members would be brought to 0 level
      by these negative levels becomes effectively destroyed. These
      negative levels are not to be thought to apply to individuals
      within the unit, merely as an abstraction to simulate the
      declining combat prowess of the weakened unit.</p>

    <h5>Destruction</h5>

      <p>A destroyed unit does not necessarily imply that every
      soldier is dead. It simply defines the fact that the unit is no
      longer a fighting force, and can be ignored. The actual soldiers
      may simply be wounded, playing dead, or sneaking off the field
      of battle.</p>

    <h5>Embedded PCs</h5>

      <p>PCs are not subject to the changing conditions of the unit as
      a whole in terms of morale or negative levels. However, they may
      take damage when the unit comes under attack: using their own AC
      vs. any attack roll, or their own saves vs. magic or area
      effect.

    <h4>Unit quality</h4>

    <table summary=Quality>

    <tr><th class='left'>Unit type</th><th class='left'>Made up of</th><th class='left'>Modifiers</th></tr>

    <tr>
        <th class='left'>Special</th>

	<td class='left'>Player characters, any other individual unit
	of 6HD or more.</td>

	<td class='left'>individual determinations, do not require command points to act-.</td>
    </tr>
    <tr>
	<th class='left'>Elite</th>

	<td class='left'>Members of PC classes of 2nd level or higher, creatures or
	NPC classes of 4HD or more.</td>

	<td class='left'>+4 to unit morale saves, +2 unit initiative, requires 1
	command point to control.</td>
    </tr>
    <tr>
	<th class='left'>Veteran</th>

	<td class='left'>Any 1st level PC classes, warriors, adepts, aristocrats,
	or battle hardened regulars of 2nd level or more.</td>

	<td class='left'>+2 to unit morale saves, +1 unit initiative, requires 1
	command point to control.</td>
    </tr>
    <tr>
	<th class='left'>Regular</th>

	<td class='left'>Warriors, adepts, trained/warlike creatures.</td>

	<td class='left'>Requires 2 command point to control.</td>
    </tr>
    <tr>
	<th class='left'>Militia</th>

	<td class='left'>Commoners and experts with little fighting experience.</td>

	<td class='left'>-2 on unit morale saves, require 3 command points to
	control.</td>

    </tr>
    <tr>
	<th class='left'>Conscripts</th>

	<td class='left'>Commoners and experts with no fighting experience.</td>

	<td class='left'>-4 on unit morale saves, require 4 command points to
	control.</td>

    </tr>
    </table>

    <h4>Attack modifiers</h4>

    <p>The units' members average attack bonus for each weapon carried
    will be determined. For example, a unit of 10 1st level warriors
    carries shortswords and spears. They have a Str bonus of +2, and a
    Dex bonus of +1. With sword, their attack will be +3, and with
    spear, +2. This may be further modified by the unit quality and
    status.</p>

    <h4>Damage</h4>

    <p>For each weapon carried by members of a unit, determine the
    average damage, and multiply that by the number of members of the
    unit carrying that weapon. For example, a unit of 10 1st level
    warriors with shortswords and +2 Str bonus would do 55 points of
    damage normally.</p>

    <h4>Initiative modifiers</h4>

    <p>This will be the unit leader's initiave, modified by other
    command structure factors, the unit's quality, and current
    status.</p>

    <h4>Speed</h4>

    <p>The speed of the units slowest member.</p>

    <h4>Special character influence on unit</h4>

    <p>The presence of special individuals in a unit will have a
    positive effect on the unit. For every 3 levels the special
    individual exceeds the general unit HD, consider the unit to be 1
    quality level higher, for example a unit of veterans (2HD
    warriors) is joined by a PC barbarian of 5th level, making the
    unit effectively 'elite'.

    <h4>Effects on Player Characters</h4>

    <p>Certain outcomes will affect the PC embedded in a unit. Attacks
    that damage the unit will only affect the PC if the attack roll
    was high enough to hit the PC. The PC will get independant saves
    for any area based attacks on the unit. The PC will not be
    affected by the unit's morale condition. A PC in a unit may rally
    (re-organize) the unit by giving up <font color='red'>n</font>
    rounds of actions, restoring d20% HP to the unit and improving its
    morale by one step. This is in addition to (and cumulative with)
    an overall command to re-organize in the battle round, and unlike
    the overall command does not expend any command points.</p>

  <h3>Actions</h3>

    <p>At the beginning of a battle round, each side determines their
    current Command Points. They then allot these points to command
    units under their control. Units can be ordered to adopt the
    following formations:

    <h4>Formations</h4>

    <table summary='unit formations'>

      <tr><th class='left'>Formation</th><th class='left'>Description</th></tr>

      <tr>
        <th class='left'>Travel</th>
	<td class='left'>The unit can move at double speed. The unit's AC is reduced by 2. The unit may not attack or take attacks of opportunity.</td>
      </tr>
      <tr>
	<th class='left'>Formed</th>
	<td class='left'>The unit may move normally, and make one attack action.</td>
      </tr>
      <tr>
	<th class='left'>Charge</th> 
	<td class='left'>The unit may move up to double to an enemy
	unit and attack, attack +2, AC -2</td>
      </tr>
      <tr>
        <th class='left'>Wedge</th>
	<td class='left'>The unit forms a wedge to better penetrate an enemy formation. Add +2 to melee attack, divide damage by 2. A successful wedge attack can, at the attacking player's option, divide the enemy unit in two, pushing one half into an adjacent square.</td>
      </tr>
      <tr>
        <th class='left'>Melee</th>
	<td class='left'>A unit that is in the same square as another may either attack or withdraw to one adjacent square and <em>Form</em> up, provoking an attack of opportunity as they withdraw.</td>
      </tr>
      <tr>
        <th class='left'>Tortoise</th>
	<td class='left'>The unit interlocks shields overhead (must have large or tower shields), granting a +4 AC bonus, may move at half speed. May not make ranged attacks.</td>
      </tr>
      <tr>
	<th class='left'>Prepared</th>
	<td class='left'>The unit may not move, AC +2, may make a full round attack, may set spears, may have a readied action.</td>
      </tr>
      <tr>
	<th class='left'>Entrenched<sup>*</sup></th>
	<td class='left'>The unit may not move, AC +6, may make a full round attack, may set spears, traps, may have a readied action</td>
      </tr>
      <tr>
        <th class='left'>Re-organize</th>
	<td class='left'>A unit may be ordered to reorganize, each such attempt granting a new will save. Success moves the unit one step up the unit-status table. Being adjacent to a better organized unit grants +2 to the check.</td>

    </table>

    <p><sup>*</sup> Requires 4 hours or a suitable spell for a unit to
    become entrenched.</p>

  <h4>Reorganization</h4>

    <p>When a unit succesfully reorganizes, it recovers HP. Roll a
    d20 to determine the percentage of full HP the re-organization
    brings about. Conversely, healing a unit assists it to
    re-organize. Any healing entitles the unit to a new check, with a
    +2 bonus for every 10% of HP healed. A unit may recover HP both
    from healing and from a succesful re-organization (brought about
    as a result of healing).</p>

  <h4>Contact.</h4>

    <p>When units contact one another (become adjacent on the
    battlefield scale), a single normal melee attack roll is made. If
    that roll succeeds against the AC of the opposing unit, then the
    attacking unit <em>may</em> merge into the enemy square. If they
    do not merge, any melee damage is divided by 4 (not all
    individuals in the unit are in direct contact), but if the unit
    has ranged weapons, the other 75% may fire them.<p>

    <p>Units in the same square as one another are like adjacent units
    in DnD: ranged attacks will draw attacks of opportunity, and
    moving out of a threatened space provokes an attack of
    opportunity.</p>

  <h4>Charge</h4>

    <p>Units may charge into other units according to the usual DnD
    rules allowing for scale: a charge is permitted even from 2
    squares away (as this represents 50 ft), but not from adjacent
    squares. Attack and damage bonuses apply as per the normal
    rules.</p>

  <h4>Attacks of Opportunity</h4>

    <p>The usual rules apply, with units allowed to make an attack of
    opportunity when another unit passes adjacent to them. See also
    <em>contact</em> above: a unit making an attack of opportunity in
    this way is allowed (on success) to move immediately into the
    enemy square.</p>

    <p>In an exception to DnD's rules, ranged weapons may also be used
    to make attacks of opportunity against units that leave a
    threatened square (determined to be any square within 2 range
    increments). Such a unit may have no more than one ranged attack
    of opportunity per battle round. (This exception is permitted
    because of the <font color='red'>n</font> combat round battle-round, in which no
    active commander would allow enemy troops to wander freely in
    front of his archers).</p>

  <h4>Resolving attacks</h4>

    <p>An attack roll is made by an entire unit as a single roll. This
    modified d20 roll is compared to the target's AC, and the result
    looked up on the following chart.</p>

    <table>
      <tr><th class='left'>Attack - AC</th><th class='left'>Damage multiplier</th></tr>
      <tr><td class='left'> &gt; 20</td><td class='left'>Quadruple damage</td></tr>
      <tr><td class='left'> &gt; 15</td><td class='left'>Triple Damage</td></tr>
      <tr><td class='left'> &gt; 10</td><td class='left'>Double damage</td></tr>
      <tr><td class='left'> &gt; 5</td><td class='left'>1.5 &times; damage</td></tr>
      <tr><td class='left'> &gt; 0</td><td class='left'>Normal damage</td></tr>
      <tr><td class='left'> &gt; -5</td><td class='left'>Half damage</td></tr>
      <tr><td class='left'> &gt; -10</td><td class='left'>Quarter damage</td></tr>
      <tr><td class='left'> &lt; -10</td><td class='left'>Zero damage</td</tr>
    </table>

  <h4>Area of effect attacks</h4>

    <p>Spells and other area-of-effect attacks are resolved against
    units as follows: if the are of effect is of a size to effect the
    entire unit, apply the full damage or other consequences to the
    unit as a whole (with any save as appropriate). PCs of course get
    their own separate save. If the are of effect is significantly
    smaller than the are occupied by the unit, pro-rate the damage, so
    if 32 HP is dealt by a flame strike in a 50 ft scale unit, (flame
    strike is of 10 ft radius) then the number of affected individuals
    would be roughly 4/25, or 16%. This is calculated by taking the
    square of the diameter of effect, and dividing by the square of
    the width of the square. A percentage roll would then also be made
    to determine if a PC or other special individual was in the area
    of effect (unless the individual had been spotted and succesfully
    targetted).</p>

<h2>Battle sequence</h2>

  <h4>Preparation</h4>

  <ol>

    <li>Determine the forces involved. Decide on an appropriate <a href='#scale'>scale</a>.</li>

    <li>Map the area, place fortifications, entrenchments and other terrain features.</li>

    <li>Determine local conditions (weather, wind, illumination).</li>

    <li>Allocate forces into units, assign PC's/heroes to units as
    desired.</li>

    <li>Create a <a href='../downloads/unit tracker.pdf'>statistics
    block</a> for each battlefield unit.</li>

    <li>Determine <a href='#points'>command points</a> for each side</li>

    <li>Locate units on the battlefield.</li>

    <li>Make and record initiative rolls for every unit.</li>

    <li>Begin Battle!</li>

  </ol>

  <h4>Battle</h4>

  <p>In order from highest initiative unit down, play goes to the side
  next in initiative.</p>

  <ol>

    <li>If command points remain, the player commanding the unit
    decides on an action for that unit (or no action, to conserve
    points). A unit may always retaliate by making a melee attack
    against an adjacent or merged unit that has atacked them (without
    expending command points).</li>

    <li>If that action triggers a ready action, the ready action is
    resolved (before the triggering action is completed).</li>

    <li>If the action triggers an attack of opportunity, that attack
    is resolved at the point at which it was triggered.</li>

    <li>Resolve the chosen action.</li>

    <li>Repeat 1 - 4 until all units have acted, or no command points (or
    retaliations) remain.</li>

    <li>Move to individual rounds for hero actions as necessary.</li>

  </ol>

  <h4>Hero actions</h4>

  <p>Move to 5 ft. = 1 in. scale map.<p>

  <p>If this is not a continuation from an earlier individual
  action:</p>

  <ol>

    <li>calculate actual count of effective individuals in the
    unit (taking into account HP losses sustained, round up).</li>

    <li>Place relevant units as individual figures.</li>

    <li>Determine initiative.</li>

  </ol>

  <p>and in any case,</p>

  <ol>

    <li>Resolve <font color='red'>n</font> rounds of combat in the usual DnD manner.</li>

    <li>Determine unit effectivess (% remaining individuals
    represented as HP on the status chart).</li>

    <li>Move back to battle turns.</li>

  </ol>

<h3>Example</h3>
  <p>So, a 5th level PC barbarian joins a unit of 20 veteran (2nd
  level) warriors armed with axes, shields and spears, and armed with
  chain shirts.

<tt><pre>
Unit Stats
Quality:        Elite (bumped up by the PC's 3 level higher Bbn)
Initiative:     +2 (the PC's initiative)
Speed:          30
AC:             17
HP:             280
Attack:         +4 axe, +3 spear
Damage:         Axe, spear 110 (20 x average dmg)
Saves:          Fort 5, Ref 1, Will 0.
</pre></tt></p>

<h4>Battle round 1.</h4>

<p>Enemy commander has a wizard ready a spell against the first unit
that breaks from enemy lines.</p>

<p>On its initiative, the unit sallies forth and heads for a unit of
archers that have been plaguing the flank of the allied lines,
stationed some 250 feet away under cover of some trees (making life
difficult for the allied archers).</p>

<p>The enemy wizard's prepared spell (fireball) engulfs the band,
dealing 18 points damage, save DC 16. A single save (rolled 8, +1)
fails, so the unit takes 18 damage. This is the first damage taken,
and it is unanswerable, and magical. The unit must make a morale save
DC 10 +4 (14). Fortunately, their status is Elite, so they gain +4 to
this save (in addition to any spells that might have been cast on
them). Unluckily, they roll 7, which is not enough. Until they can
re-organize, they are shaken. During the remainder of the battle
round, various other units move, but none is in a position to
interfere with the sorty except the archers themselves.</p>

<p>The warriors under the PC's command continue their charge towards
the archers.</p>

<p>Perceiving the threat, as the warrior's close, as an attack of
opportunity the archers launch their volley at the warriors as they
close in.

<tt><pre>
Archers (20):
Quality:        Regular
Initiative:     +2 (dex)
Speed:          30
AC:             12
HP:             180
Attack:         +3 shortbow, +1 shortsword
Damage:         66 (shortbow), 90 shortsword
Saves:          Fort 3, Ref 2, Will 0.
</pre></tt></p>

<p>They luck out rolling a 19, which comes to 22, which strikes for
1.5 times normal damage (99 points). The embedded barbarian is also
struck, since the roll was high enough to hit his AC (roll separately
for his damage). So now the warrior unit is down a total of 117
points, which is more than 25% of their total (but not 50%). Again
they must roll morale. Yeah: a 19 is enough in spite of being shaken
to avoid becoming disorganized. They are, however, now functioning at
1 negative level as a result of their losses. They plunge into the
soft ranks of the archers, rolling 17 on contact (+4 for axes = 21, +3
for spears = 20) neither of which qualify for 5 more than the required
AC 15 because of being shaken (-2)and one negative level (-1), giving
18 and 17 respectively. So damage is 110 points (since axe and ranged
spear do the same damage). The archers have been whittled down to
70HP, less than half their full total (but not down 75%). They need a
morale save of DC 20. They get a 16, which, as regulars, is not
enough. As if they were not already in enough trouble, they are now
shaken, and at 2 negative levels as a unit.</p>

<p>The action will switch to a separate map, and the time scale is
back to normal actions for up to <font color='red'>n</font> rounds. The DM determines
that 8 archers remain in (more or less) fighting form of the original
20 (70 / 180 &times; 20), whereas a our Bbn is now leading a force of
12 men.</p>

<p>The barbarian rages and they run down the stragglers (or accept
their surrender). After the battle, he takes some time to reorganize
his men under cover of the woods that had been protecting the archers,
and in so doing, he regains them 20% HP (good roll), leaving them at
163 + 56 = 225 HP (out of 280), and in good morale. This represents
finding stragglers and fallen minor wounded and re-integrating them
into the unit. The unit is now 17 warriors strong, and still a fully
effective fighting force.</p>

<p>So, in this example, the PC lent the unit 2 points of morale which
might have made some difference. He was also delivered to the enemy
and could spend the next <font color='red'>n</font> turns in hand to hand (on a separate map)
with the enemy unit and his warriors.  After the skirmish, as the unit
had suffered a loss of morale, he rallied it between battle turns.  If
the PC had tried this alone, he would have been sizzled by the wizard
and cut down by the archers on his way across. If the unit did not
have the PC, they would have been more likely to fail both saves, and
become disorganized (and thus unable to complete the attack), and
unable to re-organize themselves. A suitable 'protection from energy',
'bless' or other save improving spell would have also been useful.</p>


<p>Note that the key to quick and easy resolution is the single attack
roll on a sliding damage scale, and a simple damage allocation against
pooled hit points, in the classic DnD style.</p>

<h2>Background</h2>

  <p><a href='http://www.answers.com/topic/roman-legion'>Romans</a>
  organized soldiers in the famous 'centuries' led by a
  centurion. Smaller units of 'contubernia' comprised 8 soldiers who
  shared a tent, millstone, mule, and cooking pot. The centuries were
  actually operated in pairs called 'maniples', which were led by the
  most experienced of the two centurions.</p>

  <p>Roman cavalry (equites) consisted of about 300 horse per legion
  (about 10%), divided into 10 groups of 30 horsemen led by
  decurions.</p>

  <p>Auxilliary units such as engineers, administrators, surgeons
  etc. ammounted to the same number of men as the fighters
  themselves.</p>

  <p>In the fourteenth century, cavalry was composed of the 'lance' as
  the smallest unit, being 6 men, the knight, 2 archers and 3 servants
  for the knight. These were gathered into squadrons or 'eschelles',
  and these into larger units called banners, or banniéres or conrois
  that supposedly followed the same leader (under one heraldic banner)
  and had the same war cry. These banners were grouped into
  'bataille', or battles (hence the word) which was a massive line of
  horse.</p>

  <p>In the time of Edward II, from surviving documents we have:

  <blockquote>infantry was grouped into units of twenty under a
  vintenar and further grouped into a unit of 100 under a mounted
  constable. As for knights, twenty were led by a knight
  bannerette.</blockquote>

  <blockquote>In 1339, 374 foot from North Wales were accompanied by 6
  mounted constables, 10 other men-at-arms, a chaplin, a clerk, 4
  doctors, a crier, 7 standard-bearers and 19 vintenars.</blockquote>

  <blockquote>100 men from Anglesey in 1342 were led by a staff
  consisting of a chaplain, an interpreter, a standard-bearer, a
  crier, a doctor and 4 vintenars.</blockquote>

</body>
</html>
