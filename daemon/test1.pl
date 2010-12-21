require "./HLStats_ServerQueries.pm";

use Data::Dumper;

my $port = 27015;
my $addr = '91.144.164.241';
#my $port = 27016;
#my $addr = '127.0.0.1';


my $q = HLstats_ServerQueries->new(encoding => 'utf-8',
									timeout => 1,
									'addr' => $addr,
									'port' => $port);
my $ret = $q->getA2S_Info;
#smy $ret = $q->getA2S_Players;
#my $ret = $q->is_alive;
print Dumper($ret);
