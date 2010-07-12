require "./Net/SRCDS/Queries.pm";

use Socket;
use YAML;

use Data::Dumper;


my $port = 27111;
my $addr = '88.198.59.207';


my $q = Net::SRCDS::Queries->new(encoding => 'utf-8',
									timeout => 1,
									'addr' => $addr,
									'pot' => $port);
#my $dest = sockaddr_in $port, inet_aton $addr;
#$q->send_a2s_info($dest);
#print $q->get_result."\n";


$q->add_server( $addr, $port );
my $result = $q->get_all;
my $server = sprintf "%s:%s", $addr, $port;
#print Dumper($result);
print $result->{$server}->{info}->{version}."\n";

#warn YAML::Dump $result;



#use Net::SRCDS::Queries;
#use IO::Interface::Simple;
#use Term::Encoding qw(term_encoding);
#use YAML;

# SRCDS is listening on local server, local address
#my $if       = IO::Interface::Simple->new('wlan0');
#my $addr     = $if->address;
#my $port     = 27015;
#my $encoding = term_encoding;


#my $q = Net::SRCDS::Queries->new(
#	encoding => $encoding,  # set encoding to convert from utf8
#							# for A2S_PLAYER query.
#							#
#	timeout  => 5,          # change timeout. default is 3 seconds
#);
#$q->add_server( $addr, $port );
#warn YAML::Dump $q->get_all;

