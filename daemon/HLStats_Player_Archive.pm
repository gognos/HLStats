package HLstats_Player_Archive;
#
#
# Original development:
# +
# + HLStats - Real-time player and clan rankings and statistics for Half-Life
# + http://sourceforge.net/projects/hlstats/
# +
# + Copyright (C) 2001  Simon Garner
# +
#
# Additional development:
# +
# + UA HLStats Team
# + http://www.unitedadmins.com
# + 2004 - 2007
# +
#
#
# Current development:
# +
# + Johannes 'Banana' Keßler
# + http://hlstats.sourceforge.net
# + 2007 - 2011
# +
#
# This program is free software is licensed under the
# COMMON DEVELOPMENT AND DISTRIBUTION LICENSE (CDDL) Version 1.0
#
# You should have received a copy of the COMMON DEVELOPMENT AND DISTRIBUTION LICENSE
# along with this program; if not, visit http://hlstats-community.org/License.html
#

#
# Constructor
#
sub new {
	my $dDays = shift;
	
	print "Update player archive\n";
	
	my ($pId, $aId, $ac);
	my $playerHash = ();
	my $result = &::doQuery("SELECT `playerId`, `actionId`, COUNT(1) AS actionCount 
				FROM `${db_prefix}_Events_PlayerActions`
				WHERE eventTime < DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL $dDays DAY)
				GROUP BY playerId");
	while( ($pId, $aId, $ac) = $result->fetchrow_array ) {
		$popHash->{$pId}{$aId} = {$ac}
	}
	$result->finish;
	
	print Dumper($playerHash);
	
}

1;