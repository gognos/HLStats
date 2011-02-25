#!/usr/bin/perl
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
#
# This program is free software is licensed under the
# COMMON DEVELOPMENT AND DISTRIBUTION LICENSE (CDDL) Version 1.0
#
# You should have received a copy of the COMMON DEVELOPMENT AND DISTRIBUTION LICENSE
# along with this program; if not, visit http://hlstats-community.org/License.html
#

use strict;
use Encode;
use open qw( :std :encoding(UTF-8) );
use HTTP::Request;
use LWP::UserAgent;

# the server has those modules not installed
# extending the inlcude path with the lib dir is the new way to inlcude
# missing modules !
use lib "./lib";
use XML::Simple;

my $DEBUG = 1;

open URLHANDLE, "<", "./urls.list" or die $!;
my $ua = LWP::UserAgent->new;
while (<URLHANDLE>) {
	print $_."\n" if $DEBUG;
	my @data = split(/\|/);
	my $uri = $data[0];
	my $siteName = $data[1];

	open XMLFILE,">./xmlData/".$siteName.".xml" or die $!;

	my $request = HTTP::Request->new( GET => $uri);
	print "Requesting...\n" if $DEBUG;
	my $response = $ua->request( $request );
	print "  Status: ", $response->status_line, "\n" if $DEBUG;

	# save the content
	print XMLFILE $response->content;

	close XMLFILE;
}
#close the url file document
close URLHANDLE;

# read the xml data and write it into the db
print "Parsing xml files...\n" if $DEBUG;
my @xmlFiles = <./xmlData/*>;
foreach (@xmlFiles) {
	print "file: $_\n" if $DEBUG;
	
	# slurp the file to have the complete data
	local( *XMLFILE ) ;
    open( XMLFILE, $_ ) or die "sudden flaming death\n";
    my $content = do { local( $/ ) ; <XMLFILE> } ;

	# close the data file
	close XMLFILE;
}