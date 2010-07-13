require "./HLStats_ServerQueries.pm";

use Data::Dumper;

my $port = 27111;
my $addr = '88.198.59.207';

my $q = HLstats_ServerQueries->new(encoding => 'utf-8',
									timeout => 1,
									'addr' => $addr,
									'port' => $port);
my $ret = $q->getA2S_Info;
#smy $ret = $q->getA2S_Players;
#my $ret = $q->is_alive;
print Dumper($ret);
